<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoginInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('betsys_login_info',function(Blueprint $table)
        {
            $table->integer('user_id')->primary();
            $table->dateTime('last_login_at');
            //连续登录天数
            $table->tinyInteger('consecutive_login_days');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('betsys_login_info');
    }
}
