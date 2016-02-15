<?php

use Illuminate\Database\Seeder;
use MPOproperty\Mpouspehm\Models\StatusTransaction;


class StatusTransactionSeeder extends Seeder
{
    public function run()
    {
        StatusTransaction::create([
            'status' => 'STATUS_EXHIBITED',
            'description' => 'Счет выставлен',
        ]);

        StatusTransaction::create([
            'status' => 'STATUS_NOT_PAID',
            'description' => 'Недоплата',
        ]);

        StatusTransaction::create([
            'status' => 'STATUS_PAID',
            'description' => 'Оплачен',
        ]);

        StatusTransaction::create([
            'status' => 'STATUS_OVERPAID',
            'description' => 'Переплата',
        ]);

        StatusTransaction::create([
            'status' => 'STATUS_REJECTED',
            'description' => 'Отклонен',
        ]);

        StatusTransaction::create([
            'status' => 'STATUS_CANCELED',
            'description' => 'Отменен',
        ]);

        StatusTransaction::create([
            'status' => 'STATUS_CANCELED',
            'description' => 'Истек',
        ]);
    }

}