<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBetHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('betsys_bet_history',function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id');
            //how many times the user bet
            $table->integer('bet_number');
            // how many times the user win
            $table->integer('win_number');
            $table->integer('lose_number');
            $table->integer('cost_history');
            $table->integer('reward_history');
            $table->integer('most_win_combo_record');
            $table->integer('most_point_record');
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
        Schema::dropIfExists('betsys_bet_history');
    }
}
