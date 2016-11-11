<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Backpack\CRUD\CrudTrait;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Backpack\Base\app\Notifications\ResetPasswordNotification as ResetPasswordNotification;



class User extends Authenticatable
{
    use Notifiable;
    use CrudTrait;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','tm_team_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }



    /**
     * 获取用户的point
     * 一对一
     */
    public function userPoint()
    {
        return $this->hasOne('App\UserPoint','user_id','id');
    }

    /**
     * 获取用户的login_info
     * 一对一
     */
    public function loginInfo()
    {
        return $this->hasOne('App\LoginInfo','user_id','id');
    }

    /**
     * 获取用户的球队
     * 一对一
     */
    public function team()
    {
        return $this->hasOne('App\Team','tm_team_id','id');
    }

    /**
     * 获取用户的竞猜记录
     * 一对多
     */
    public function bets()
    {
        return $this->hasMany('App\Bet','user_id','id');
    }

    /**
     * 获取用户发的通告
     * 一对多
     */
    public function announcements()
    {
        return $this->hasMany('App\Announcement','user_id','id');
    }

}
