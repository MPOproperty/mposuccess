<?php

use Illuminate\Database\Seeder;
use MPOproperty\Mposuccess\Models\TypeConclusion;

class TypeConclusionSeeder extends Seeder
{
    public function run()
    {
        TypeConclusion::create([
            'name'  => 'VISA, MasterCard',
            'description'  => '',
        ]);

        TypeConclusion::create([
            'name'  => 'WebMoney',
            'description'  => '',
        ]);

        TypeConclusion::create([
            'name'  => 'Яндекс.Деньги',
            'description'  => '',
        ]);
    }

}