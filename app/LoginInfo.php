<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class LoginInfo extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'betsys_login_info';

    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = false;
    //自定义主键
    protected $primaryKey = 'user_id';
    //使用非自增主键
    public $incrementing = false;


    public function __construct()
    {
        $this->last_login_at = Carbon::now();
        $this->consecutive_login_days = 0;
    }

    /**
     * 获取login_info对应的用户
     * 一对一
     */
    public function user()
    {
        return $this->belongsTo('App\User','id','user_id');
    }
}
