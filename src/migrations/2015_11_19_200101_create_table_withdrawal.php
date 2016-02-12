<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableWithdrawal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdrawals', function(Blueprint $table)
        {
            $table->increments('id');
            $table->smallInteger('status_id');
            $table->integer('user_id');
            $table->string('description', 255);
            $table->integer('price');
        });

        Schema::table('withdrawals', function(Blueprint $table){
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('withdrawals');
    }
}
