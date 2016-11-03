<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatchResult extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'betsys_match_result';

    /**
     * 获取result对应的match
     * 一对一
     */
    public function match()
    {
        return $this->belongsTo('App\match','match_id','match_id');
    }

}
