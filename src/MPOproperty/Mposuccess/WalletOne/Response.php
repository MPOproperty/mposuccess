<?php

namespace MPOproperty\Mposuccess\WalletOne;

use MPOproperty\Mposuccess\Repositories\Transaction\StatusTransactionRepository;
use MPOproperty\Mposuccess\Repositories\Transaction\TransactionRepository;
use MPOproperty\Mposuccess\Repositories\Transaction\TypeTransactionRepository;
use MPOproperty\Mposuccess\WalletOne;

/**
 * Class {
 * @package MPOproperty\Walletone
 */
class Response extends Request
{
    private $data;

    /**
     * TransactionRepository
     * @var
     */
    protected $transaction;

    /**
     * StatusTransactionRepository
     * @var
     */
    protected $status;

    /**
     * PaymentRepository
     * @var
     */
    protected $payment;

    /**
     * TypeTransactionRepository
     * @var
     */
    protected $type;

    function __construct()
    {
        $transaction = app('MPOproperty\Mposuccess\Repositories\Transaction\TransactionRepository');
        $status = app('MPOproperty\Mposuccess\Repositories\Transaction\StatusTransactionRepository');
        $type = app('MPOproperty\Mposuccess\Repositories\Transaction\TypeTransactionRepository');
        $payment = app('MPOproperty\Mposuccess\Repositories\Payment\PaymentRepository');

        $this->transaction = $transaction;
        $this->status = $status;
        $this->type = $type;
        $this->payment = $payment;
    }

    /**
     * Check response wrom walletone
     * @param $request
     */
    public function checkResponse($request)
    {
        try {
            if (!isset($_POST["WMI_SIGNATURE"]) || !isset($_POST["WMI_PAYMENT_NO"]) || !isset($_POST["WMI_ORDER_STATE"])) {
                $this->responseAnswer("Retry", "Некорректные параметры запроса");
            }

            foreach ($_POST as $name => $value) {
                if ($name !== "WMI_SIGNATURE") {
                    $this->data[$name] = $value;
                }
            }

            $this->logToFile('Time = ' . date('D-m-Y H:i:s', time()));
            $signature = $this->genResponseSignature($this->data);

            if ($signature == $_POST["WMI_SIGNATURE"]) {
                if (strtoupper($_POST["WMI_ORDER_STATE"]) == "ACCEPTED") {
                    $resultTransaction = $this->transaction->changeTransactionStatus($_POST["WMI_PAYMENT_NO"],
                        $this->status->getStatusPaid());
                    if ($resultTransaction) {
                        $this->payment->changeBalance(
                            $resultTransaction->user_id,
                            $resultTransaction->price,
                            TypeTransactionRepository::TYPE_INTAKE_INTERNAL,
                            $this->type
                        );

                        $this->payment->setPaymentNotification(
                            $resultTransaction->user_id,
                            trans('mposuccess::payment.notificationNames.INTAKE_INTERNAL'),
                            trans('mposuccess::payment.notificationMessages.INTAKE_INTERNAL',
                                array('sum' => $resultTransaction->price))
                        );

                        $this->logToFile('Order payment');
                        $this->responseAnswer("Ok", "Заказ #" . $_POST["WMI_PAYMENT_NO"] . " оплачен!");
                    }
                } else {
                    // Пришло неизвестное состояние заказа
                    $this->logToFile('Order don\'t payment');
                    $this->responseAnswer("Retry", "Неверное состояние " . $_POST["WMI_ORDER_STATE"]);
                }
            } else {
                $this->logToFile('Signature not equal');
                $this->responseAnswer("Retry", "Неверная подпись " . $_POST["WMI_SIGNATURE"]);
            }
        } catch (\Exception $ex) {
            $this->logToFile($ex);
        }
    }

    /**
     * Answer to walletone
     * @param $result
     * @param $description
     */
    public function responseAnswer($result, $description)
    {
        print "WMI_RESULT=" . strtoupper($result) . "&";
        print "WMI_DESCRIPTION=" . urlencode($description);
        exit();
    }

    //todo Оставить на время тестов
    function logToFile($text)
    {
        $fp = fopen('file.txt', 'a');
        fwrite($fp, $text . PHP_EOL);
        fclose($fp);
    }

    /**
     * Generate signature to response
     * @param array $params
     * @param string $str
     * @return string
     */
    public function genResponseSignature($params = array(), $str = '')
    {
        uksort($params, "strcasecmp");

        array_walk_recursive($params, function ($value) use (&$str) {
            if (is_array($value)) { // массив типов платежей
                foreach ($value as $v) {
                    $str .= $v;
                }
            } else {
                $str .= $value;
            }
        });

        return base64_encode(pack("H*", md5($str . config('welletone.WMI_KEY'))));
    }
}