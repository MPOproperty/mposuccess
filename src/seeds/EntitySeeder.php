<?php

use Illuminate\Database\Seeder;
use MPOproperty\Mposuccess\Models\Entity;

class EntitiesSeeder extends Seeder {

    public function run()
    {
        /*
         * Create test entities
         */
        Entity::create([
            'name'          => 'COOL GREEN DRESS WITH RED BELL',
            'description'   => 'Description COOL GREEN DRESS WITH RED BELL.',
            'image'         => 'model1.jpg',
        ]);
        Entity::create([
            'name'          => 'BERRY LACE DRESS',
            'description'   => 'Description BERRY LACE DRESS.',
            'image'         => 'model2.jpg',
        ]);
        Entity::create([
            'name'          => 'BERRY LACE DRESS 2',
            'description'   => 'Description COOL BERRY LACE DRESS 2.',
            'image'         => 'model3.jpg',
        ]);
        Entity::create([
            'name'          => 'NEW NEW NEW',
            'description'   => 'Description NEW NEW NEW.',
            'image'         => 'model4.jpg',
        ]);
        Entity::create([
            'name'          => 'SALE SALE SALE',
            'description'   => 'Description SALE SALE SALE.',
            'image'         => 'model5.jpg',
        ]);

        Entity::create([
            'name'          => 'Test Test Test',
            'description'   => 'Description Test Test Test.',
            'image'         => '',
        ]);
    }
}
