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
            // cost how many points to bet
            $table->integer('cost');
            // win some points from a bet
            $table->integer('reward');
            $table->string('result');
            //连续竞猜正确数
            $table->integer('combos');
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
        Schema::dropIfExists('betsys_bet_info');
    }
}
