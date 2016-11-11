<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Odds extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'betsys_odds_info';


    /**
     * 获取赔率所对应的比赛
     */
    public function match()
    {
        return $this->belongsTo('App\Match');
    }

    /**
     * 获取赔率对应的竞猜记录
     * 一对多
     */
    public function bets()
    {
        return $this->hasMany('App\Bet','odds_id','id');
    }

}
