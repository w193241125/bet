<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('betsys_point_info',function(Blueprint $table)
        {
            $table->integer('user_id')->primary();
            $table->date('last_sign_at');
            //连续签到天数
            $table->tinyInteger('consecutive_sign_days')->default(0);
            $table->integer('point')->default(0);
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
        Schema::dropIfExists('betsys_point_info');
    }
}
