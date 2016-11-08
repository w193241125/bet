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
        return $this->hasOne('App\MatchResult','match_id','match_id');
    }


}
