<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BetInfo extends Model
{
    //
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'betsys_bet_info';

    //自定义主键
    protected $primaryKey = 'bet_id';
    //使用非自增主键
    public $incrementing = false;

    /**
     * 获取bet_info对应的bet
     * 一对一
     */
    public function bet()
    {
        return $this->belongsTo('App\Bet','id','bet_id');
    }
}
