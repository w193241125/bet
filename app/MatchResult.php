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

    //自定义主键
    protected $primaryKey = 'match_id';
    //使用非自增主键
    public $incrementing = false;

    /**
     * 获取result对应的match
     * 一对一
     */
    public function match()
    {
        return $this->belongsTo('App\match','match_id','match_id');
    }

}
