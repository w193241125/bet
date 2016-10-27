<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('betsys_match_info',function(Blueprint $table)
        {
            $table->increments('match_id');
            $table->dateTime('fixture');
            $table->dateTime('deadline');
            $table->integer('tm_match_id');
            $table->integer('home_team_id');
            $table->integer('away_team_id');
            $table->tinyInteger('home_score');
            $table->tinyInteger('away_score');
            $table->tinyInteger('match_state');
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
    }
}
