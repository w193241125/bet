<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Announcement extends Model
{
    use CrudTrait;
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'betsys_announcement';

    protected $fillable = ['title','body','user_id'];

    /**
     * 获取通告对应的用户
     * 多对一
     */
    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }



}
