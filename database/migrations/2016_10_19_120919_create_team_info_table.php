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
            //team id primary key
            $table->increments('id');
            $table->string('tm_team_id')->unique()->default(0);
            $table->string('team_name')->default(config('bet.bet.default_team_name'));
            //is tm national team
            $table->boolean('is_tm_nt')->default(0);
            $table->string('team_url');
            $table->string('league_url');
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
        Schema::dropIfExists('betsys_team_info');
    }
}
