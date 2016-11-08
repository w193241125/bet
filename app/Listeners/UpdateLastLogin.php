<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;
use Auth;


class UpdateLastLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {

        $user = Auth::user();
        $login_info = $user->loginInfo;
        $las_login_at = $login_info->last_login_at;



        //如果是昨天登录且小于最大连续登录天数，连续登录天数+1
        if(Carbon::createFromFormat('Y-m-d H:i:s',$las_login_at)->isYesterday()&&($user->loginInfo->consecutive_login_days<config('bet/bet.max_login_days')))
        {
            $login_info->consecutive_login_days += 1;
        }
        //如果是过去，连续登录天数设置为0
        if(Carbon::createFromFormat('Y-m-d H:i:s',$las_login_at)->lte(Carbon::yesterday()))
        {
            $login_info->consecutive_login_days = 0;
        }

        $login_info->last_login_at = Carbon::now();

        $login_info->save();



    }
}
