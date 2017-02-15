<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\LoginInfo;
use App\UserPoint;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;
use Auth;

//登录时比对上次登录，更新登录信息
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

        //判断是否存在login数据，如果没有就创建此用户的login info，如果存在就获取对应的login info
        if(!isset($user->loginInfo))
        {
            $login_info = new LoginInfo();
            $login_info->user_id = $user->id;

        }
        else
        {
            $login_info = $user->loginInfo;
        }

        //判断是否存在user point数据，如果没有就初始化
        if(!isset($user->userPoint))
        {
            $user_point = new UserPoint();
            $user_point->user_id = $user->id;

            $user_point->point = 100;
            $user_point->save();
        }
        $las_login_at = $login_info->last_login_at;

        //如果是昨天登录且小于最大连续登录天数，连续登录天数+1
        if(Carbon::createFromFormat('Y-m-d H:i:s',$las_login_at)->isYesterday()&&($user->loginInfo->consecutive_login_days<config('bet.bet.max_login_days')))
        {
            $login_info->consecutive_login_days += 1;
        }
        //如果是昨天之前登录，连续登录天数设置为0
        if(Carbon::createFromFormat('Y-m-d H:i:s',$las_login_at)->lte(Carbon::yesterday()))
        {
            $login_info->consecutive_login_days = 0;
        }

        $login_info->last_login_at = Carbon::now();
        $login_info->save();

    }
}
