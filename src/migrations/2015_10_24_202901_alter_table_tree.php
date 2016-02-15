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
        Schema::table('tree3', function(Blueprint $table)
        {
            $table->integer('number');
            $table->integer('n');
            $table->boolean('reborn');
            $table->integer('parent');
        });

        Schema::table('tree6', function(Blueprint $table)
        {
            $table->integer('number');
            $table->integer('n');
            $table->boolean('reborn');
            $table->integer('parent');
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
            $table->dropColumn([
                'number',
                'n',
                'reborn',
                'parent'
            ]);
        });

        Schema::table('tree6', function(Blueprint $table)
        {
            $table->dropColumn([
                'number',
                'n',
                'reborn',
                'parent'
            ]);
        });
    }
}
