<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableTreeTwo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('tree3', function(Blueprint $table)
        {
            $table->integer('m')->default(0);
        });

        Schema::table('tree6', function(Blueprint $table)
        {
            $table->integer('m')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tree3', function(Blueprint $table)
        {
            $table->dropColumn('m');
        });
        Schema::table('tree6', function(Blueprint $table)
        {
            $table->dropColumn('m');
        });
    }
}
