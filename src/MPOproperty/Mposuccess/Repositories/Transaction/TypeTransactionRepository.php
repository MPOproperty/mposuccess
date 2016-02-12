<?php

namespace MPOproperty\Mposuccess\Repositories\Transaction;

use MPOproperty\Mposuccess\Models\TypeTransaction;
use MPOproperty\Mposuccess\Repositories\Repository;

class TypeTransactionRepository extends Repository
{
    /**
     * Внутреннее поступление
     */
    CONST TYPE_INTAKE_INTERNAL = 1;

    /**
     * Внешнее поступление
     */
//    CONST TYPE_INTAKE_EXTERNAL = 2;

    /**
     * Внутреннее отчисление (покупка)
     */
    CONST TYPE_DEDUCTION_INTERNAL = 3;

    /**
     * Внешнее отчисление
     */
//    CONST TYPE_DEDUCTION_EXTERNAL = 4;

    /**
     * Внутренний перевод
     */
    CONST TYPE_ACCOUNT_TRANSFER = 5;

    /**
     * Отчисление от компании
     */
    CONST TYPE_EXPULSION_FROM_COMPANY = 6;

    /**
     * Вывод средств
     */
    CONST TYPE_WITHDRAWAL = 7;


    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'MPOproperty\Mposuccess\Models\TypeTransaction';
    }

    /**
     * Типы для таблицы транзакция у администратора
     * @return mixed
     */
    public function getTypesToTransactionTable()
    {
        $types = TypeTransaction::whereIn('id', [
            $this::TYPE_INTAKE_INTERNAL,
            $this::TYPE_DEDUCTION_INTERNAL,
            $this::TYPE_ACCOUNT_TRANSFER,
            $this::TYPE_EXPULSION_FROM_COMPANY,
            $this::TYPE_WITHDRAWAL
        ])->get();

        return $types;
    }

    /**
     * Возвращает типы по массиву ids
     *
     * @param $params
     * @return mixed
     */
    public function getTypesByIds($params)
    {
        $types = TypeTransaction::whereIn('id', $params)->get();

        return $types;
    }
}