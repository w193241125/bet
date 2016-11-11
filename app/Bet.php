<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bet extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'betsys_bet';


    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * 获取bet_info
     * 一对一
     */
    public function betInfo()
    {
        return $this->hasOne('App\BetInfo','bet_id','id');
    }

    /**
     * 获取bet对应的用户
     * 多对一
     */
    public function user()
    {
        return $this->belongsTo('App\User','id','user_id');
    }

    /**
     * 获取bet对应的赔率
     * 多对一
     */
    public function odds()
    {
        return $this->belongsTo('App\Odds','id','odds_id');
    }

}
