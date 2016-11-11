<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class announcement extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'betsys_announcement';

    /**
     * 获取通告对应的用户
     * 多对一
     */
    public function user()
    {
        return $this->belongsTo('App\User','id','user_id');
    }



}
