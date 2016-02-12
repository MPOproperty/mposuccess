<?php

namespace MPOproperty\Mposuccess\Repositories\Payment;

use MPOproperty\Mposuccess\Models\Notification;
use MPOproperty\Mposuccess\Models\Payment;
use MPOproperty\Mposuccess\Models\User;
use MPOproperty\Mposuccess\Repositories\Repository;
use MPOproperty\Mposuccess\Repositories\Transaction\TypeTransactionRepository;
use DB as DBTransaction;

class PaymentRepository extends Repository
{
    /**
     * Дополнительный процент на оплату в процентах
     */
    const TAX = 10;
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'MPOproperty\Mposuccess\Models\Payment';
    }

    /**
     * Изменение баланса ользователя
     *
     * @param $userId
     * @param $sum
     * @param $type
     * @param TypeTransactionRepository $ttr
     * @return mixed
     */
    public function changeBalance($userId, $sum, $type, TypeTransactionRepository $ttr)
    {
        $payment = self::findBalanceById($userId);

        if ($type == $ttr::TYPE_INTAKE_INTERNAL || $type == $ttr::TYPE_EXPULSION_FROM_COMPANY) {
            $payment->balance += $sum;
        }

        if ($type == $ttr::TYPE_DEDUCTION_INTERNAL || $type == $ttr::TYPE_WITHDRAWAL) {
            $payment->balance -= $sum;
        }

        return $payment->save();
    }

    /**
     * Инициализация баланса пользователя в БД
     *
     * @param $userId
     * @return bool
     */
    private function createUserBalance($userId)
    {
        $payment = new Payment();
        $payment->id = $userId;
        $payment->balance = 0;

        return $payment->save();
    }

    /**
     * Поиск баланса пользователя. Возвращает модель.
     *
     * @param $userId
     * @return mixed
     */
    public function findBalanceById($userId)
    {
        $balance = Payment::find($userId);

        if (!$balance) {
            self::createUserBalance($userId);
            $balance = Payment::find($userId);
        }

        return $balance;
    }

    /**
     * Проверка, есть ли у пользователя доступные средства на балансе
     *
     * @param $balance
     * @param $sum
     * @return bool
     */
    public function checkIsIssetMoney($balance, $sum)
    {
        return (($balance - $sum) >= 0) ? true : false;
    }

    /**
     * Проверка, есть ла на балансе пользователя переданная в параметре сумма
     *
     * @param $userId
     * @param $sum
     * @return bool
     */
    public function isValidBalance($userId, $sum)
    {
        $userBalance = $this->findBalanceById($userId);

        return $this->checkIsIssetMoney($userBalance->balance, $sum);
    }

    /**
     * Добавление уведомлений пользователю о денежных операциях
     *
     * @param $userId
     * @param $name
     * @param $message
     */
    public function setPaymentNotification($userId, $name, $message)
    {
        $user = User::find($userId);

        if ($user) {
            $user->notifications()->save(
                new Notification([
                    'name' => $name,
                    'text' => $message
                ])
            );
        }
    }

    /**
     * Возвращает форматированный текущий баланс пользователя
     *
     * @param $userId
     * @return mixed
     */
    public function getUserBalance($userId)
    {
        $balance = self::findBalanceById($userId);

        return $balance->balance . 'р';
    }

    /**
     * Внутреннее отчисление
     *
     * @param $levelPrice
     * @param $userId
     * @param $description

     * @return bool
     */
    public function internalPayment(
        $levelPrice,
        $userId,
        $description
    )
    {
        $transaction = $user = app('MPOproperty\Mposuccess\Repositories\Transaction\TransactionRepository');
        $type = app('MPOproperty\Mposuccess\Repositories\Transaction\TypeTransactionRepository');
        $status =  app('MPOproperty\Mposuccess\Repositories\Transaction\StatusTransactionRepository');

        DBTransaction::transaction(function() use ($levelPrice, $userId, $status, $transaction, $type, $description) {
            $this->changeBalance($userId, $levelPrice, $type::TYPE_DEDUCTION_INTERNAL, $type);

            $transactionData = [
                'status' => $status::STATUS_PAID,
                'type' => $type::TYPE_DEDUCTION_INTERNAL,
                'user' => $userId,
                'description' => $description,
                'price' => $levelPrice,
                'from' => $userId,
                'to' => 0
            ];

            $transaction->createTransaction($transactionData);

            $this->setPaymentNotification(
                $userId,
                trans('mposuccess::payment.notificationNames.DEDUCTION_INTERNAL'),
                trans('mposuccess::payment.notificationMessages.DEDUCTION_INTERNAL', array('sum' => $levelPrice))
            );
        });

        return true;
    }


    /**
     * Отчисление от компании
     *
     * @param $sum
     * @param $toUserId
     * @param $phaseDescription
     * @return bool
     */
    public function intakeExternalPayment($sum, $toUserId, $phaseDescription)
    {
        DBTransaction::transaction(function() use ($sum, $toUserId, $phaseDescription) {

            $transaction = $user = app('MPOproperty\Mposuccess\Repositories\Transaction\TransactionRepository');
            $type = app('MPOproperty\Mposuccess\Repositories\Transaction\TypeTransactionRepository');
            $status =  app('MPOproperty\Mposuccess\Repositories\Transaction\StatusTransactionRepository');

            $this->changeBalance($toUserId, $sum, $type::TYPE_EXPULSION_FROM_COMPANY, $type);

            $transactionData = [
                'status' => $status::STATUS_PAID,
                'type' => $type::TYPE_EXPULSION_FROM_COMPANY,
                'user' => 0,
                'description' => $phaseDescription,
                'price' => $sum,
                'from' => 0,
                'to' => $toUserId
            ];

            $transaction->createTransaction($transactionData);

            $this->setPaymentNotification(
                $toUserId,
                $phaseDescription,
                trans('mposuccess::payment.notificationMessages.EXPULSION_COMPANY', array('sum' => $sum))
            );
        });

        return true;
    }

    /**
     * Добавляет к стоимости налоги и приводит к денежному формату для передачи в Walletone
     * @param $price
     * @return string
     */
    public static function calculatePriceWithTax($price)
    {
        $priceWithTax = $price + ($price * self::TAX) / 100;

        return number_format((float)$priceWithTax, 2, '.', '');
    }


}