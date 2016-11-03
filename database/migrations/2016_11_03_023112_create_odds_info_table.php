<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOddsInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('betsys_odds_info',function(Blueprint $table)
        {
            $table->increments('odds_id');
            $table->integer('match_id');
            $table->decimal('odds', 5, 2);
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
        Schema::drop('betsys_odds_info');
    }
}
