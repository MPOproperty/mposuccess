<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTableProductEntities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_entities', function($table)
        {
            $table->integer('product_id')->unsigned();
            $table->integer('entity_id')->unsigned();
            $table->integer('count')->unsigned();
            $table->unique(['product_id', 'entity_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_entities');
    }
}
