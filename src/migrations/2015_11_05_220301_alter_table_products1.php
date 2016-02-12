<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableProducts1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function(Blueprint $table)
        {
            $table->enum('tag', array('sale', 'new'));
            $table->smallInteger('count')
                    ->unsigned()
                    ->default(1);
            $table->smallInteger('level')
                ->unsigned()
                ->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function(Blueprint $table)
        {
            $table->dropColumn('count');
            $table->dropColumn('tag');
            $table->dropColumn('level');
        });
    }
}
