<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableWithdrawal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('withdrawals', function (Blueprint $table) {
            $table->timestamp('date');
        });

        Schema::table('withdrawals', function (Blueprint $table) {
            $table->smallInteger('method_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('withdrawals', function (Blueprint $table) {
            $table->dropColumn('date');
        });

        Schema::table('withdrawals', function (Blueprint $table) {
            $table->dropColumn('method_id');
        });

    }
}
