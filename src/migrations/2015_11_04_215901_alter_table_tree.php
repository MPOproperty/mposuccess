<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableTree extends Migration
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
            $table->timestamp('time')->nullable();
        });
        Schema::table('tree2', function(Blueprint $table)
        {
            $table->timestamp('time')->nullable();
        });
        Schema::table('tree3', function(Blueprint $table)
        {
            $table->timestamp('time')->nullable();
        });
        Schema::table('tree4', function(Blueprint $table)
        {
            $table->timestamp('time')->nullable();
        });
        Schema::table('tree5', function(Blueprint $table)
        {
            $table->timestamp('time')->nullable();
        });
        Schema::table('tree6', function(Blueprint $table)
        {
            $table->timestamp('time')->nullable();
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
            $table->dropColumn('time');
        });
        Schema::table('tree2', function(Blueprint $table)
        {
            $table->dropColumn('time');
        });
        Schema::table('tree3', function(Blueprint $table)
        {
            $table->dropColumn('time');
        });
        Schema::table('tree4', function(Blueprint $table)
        {
            $table->dropColumn('time');
        });
        Schema::table('tree5', function(Blueprint $table)
        {
            $table->dropColumn('time');
        });
        Schema::table('tree6', function(Blueprint $table)
        {
            $table->dropColumn('time');
        });
    }
}
