<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreeSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tree_settings', function($table)
        {
            $table->increments('id');
            $table->integer('level');
            $table->integer('cells_to_fill');
            $table->integer('first_pay');
            $table->integer('next_pay');
            $table->integer('sum_pay');
            $table->integer('invited');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tree_settings');
    }
}
