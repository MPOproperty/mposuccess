<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTree extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tree1', function(Blueprint $table)
        {
            $table->integer('id', false, true);
            $table->integer('user_id')->nullable();
        });
        Schema::create('tree2', function(Blueprint $table)
        {
            $table->integer('id', false, true);
            $table->integer('user_id')->nullable();
        });
        Schema::create('tree3', function(Blueprint $table)
        {
            $table->integer('id', false, true);
            $table->integer('user_id')->nullable();
        });
        Schema::create('tree4', function(Blueprint $table)
        {
            $table->integer('id', false, true);
            $table->integer('user_id')->nullable();
        });
        Schema::create('tree5', function(Blueprint $table)
        {
            $table->integer('id', false, true);
            $table->integer('user_id')->nullable();
        });
        Schema::create('tree6', function(Blueprint $table)
        {
            $table->integer('id', false, true);
            $table->integer('user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tree1');
        Schema::dropIfExists('tree2');
        Schema::dropIfExists('tree3');
        Schema::dropIfExists('tree4');
        Schema::dropIfExists('tree5');
        Schema::dropIfExists('tree6');
    }
}
