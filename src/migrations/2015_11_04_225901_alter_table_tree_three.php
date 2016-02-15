<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableTreeThree extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tree1', function(Blueprint $table)
        {
            $table->dropColumn('time');
            $table->integer('number')->default(0);
        });

        Schema::table('tree4', function(Blueprint $table)
        {
            $table->dropColumn('time');
            $table->integer('number')->default(0);
        });

        Schema::table('tree2', function(Blueprint $table)
        {
            $table->dropColumn('time');
            $table->integer('number')->default(0);
        });

        Schema::table('tree5', function(Blueprint $table)
        {
            $table->dropColumn('time');
            $table->integer('number')->default(0);
        });

        Schema::table('tree3', function(Blueprint $table)
        {
            $table->dropColumn('time');
            $table->integer('number')->default(0);
        });

        Schema::table('tree6', function(Blueprint $table)
        {
            $table->dropColumn('time');
            $table->integer('number')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tree1', function(Blueprint $table)
        {
            $table->dropColumn('number');
        });
        Schema::table('tree4', function(Blueprint $table)
        {
            $table->dropColumn('number');
        });
        Schema::table('tree2', function(Blueprint $table)
        {
            $table->dropColumn('number');
        });
        Schema::table('tree5', function(Blueprint $table)
        {
            $table->dropColumn('number');
        });
        Schema::table('tree3', function(Blueprint $table)
        {
            $table->dropColumn('number');
        });
        Schema::table('tree6', function(Blueprint $table)
        {
            $table->dropColumn('number');
        });
    }
}
