<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('betsys_team_info',function(Blueprint $table)
        {
            $table->increments('team_id');
            $table->string('tm_team_id');
            $table->string('team_name');
            $table->boolean('is_tm_nt');
            $table->boolean('is_real');
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
        Schema::drop('betsys_team_info');
    }
}
