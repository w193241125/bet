<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBetInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('betsys_bet_info',function(Blueprint $table)
        {
            $table->integer('bet_id')->primary();
            $table->integer('user_id');

            $table->integer('match_id');

            // cost how many points to bet
            $table->integer('cost');
            // win some points form a bet
            $table->integer('reward');
            $table->string('result');
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
        //
        Schema::drop('betsys_bet_info');
    }
}
