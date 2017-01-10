<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BetHistory extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'betsys_bet_history';

    public function __construct()
    {
        parent::__construct();
        $this->bet_number = 0;
        $this->win_number = 0;
        $this->lose_number = 0;
        $this->cost_history = 0;
        $this->reward_history = 0;
        $this->most_win_combo_record = 0;
        $this->most_point_record = 0;
    }

    /**
     * 获取对应的用户
     * 一对一
     */
    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
}
