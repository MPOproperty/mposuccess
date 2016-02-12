<?php

namespace MPOproperty\Mposuccess\Repositories\Transaction;

use MPOproperty\Mposuccess\Models\StatusTransaction;
use MPOproperty\Mposuccess\Repositories\Repository;

class StatusTransactionRepository extends Repository
{

    /**
     * Выставлен — счет сформирован и ожидает оплаты. Время, в течение которого счет может быть оплачен,
     * может задаваться интернет-магазином
     */
    CONST STATUS_EXHIBITED = 1;

    /**
     * Недоплачен — сумма платежа недостаточна для погашения выставленного счета.
     */
    CONST STATUS_NOT_PAID = 2;

    /**
     *  Оплачен — оплата прошла полностью и зачислена на счет интернет-магазина.
     */
    CONST STATUS_PAID = 3;

    /**
     * Переплачен — на счет интернет-магазина поступила излишняя сумма.
     */
    CONST STATUS_OVERPAID = 4;

    /**
     * Отклонен — покупатель отклонил оплату счета.
     */
    CONST STATUS_REJECTED = 5;

    /**
     * Отменен — интернет-магазин отменил оплату счета.
     */
    CONST STATUS_CANCELED = 6;

    /**
     * Истек — срок действия счета истек, при необходимости нужно выставить его повторно.
     */
    CONST STATUS_EXPIRED = 7;


    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'MPOproperty\Mposuccess\Models\StatusTransaction';
    }

    /**
     * Получение id статуса "Оплачено"
     * @return int
     */
    public function getStatusPaid()
    {
        return self::STATUS_PAID;
    }

    /**
     * Возвращает статусы для запросов на вывод средств
     * @return mixed
     */
    public function getWithdrawalStatus()
    {
        $statuses = StatusTransaction::whereIn('id', [$this::STATUS_EXHIBITED, $this::STATUS_PAID, $this::STATUS_REJECTED])->get();

        return $statuses;
    }


}