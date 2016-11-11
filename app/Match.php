<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    //
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'betsys_match_info';

    /**
     * 获取比赛的结果
     * 一对一
     */
    public function matchResult()
    {
        return $this->hasOne('App\MatchResult','match_id','id');
    }


    /**
     * 获取比赛的赔率
     * 一对多
     */
    public function odds()
    {
        return $this->hasMany('App\Odds','match_id','id');
    }

    /**
     * 获取此比赛的竞猜信息
     * 远程一对多
     */
    public function bets()
    {
        return $this->hasManyThrough('App\Bet', 'App\Odds','match_id','odds_id');
    }


}
