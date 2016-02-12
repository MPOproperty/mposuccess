<?php

use Illuminate\Database\Seeder;
use MPOproperty\Mposuccess\Models\TypeTransaction;

class TypeTransactionSeeder extends Seeder
{
    public function run()
    {
        TypeTransaction::create([
            'type'  => 'TYPE_INTAKE_INTERNAL',
            'description'  => 'Пополнение', //Внутреннее поступление
        ]);

        TypeTransaction::create([
            'type'  => 'TYPE_INTAKE_EXTERNAL',
            'description'  => 'Пополнение', //Внешнее поступление
        ]);

        TypeTransaction::create([
            'type'  => 'TYPE_DEDUCTION_INTERNAL',
            'description'  => 'Покупка', //Внутреннее отчисление
        ]);

        TypeTransaction::create([
            'type'  => 'TYPE_DEDUCTION_EXTERNAL',
            'description'  => 'Внешнее отчисление',
        ]);

        TypeTransaction::create([
            'type'  => 'TYPE_ACCOUNT_TRANSFER',
            'description'  => 'Перевод',
        ]);

        TypeTransaction::create([
            'type'  => 'TYPE_EXPULSION_FROM_COMPANY',
            'description'  => 'Бонусы',
        ]);

        TypeTransaction::create([
            'type'  => 'TYPE_WITHDRAWAL',
            'description'  => 'Вывод',
        ]);
    }

}