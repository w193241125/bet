<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Backpack\CRUD\CrudTrait;
use Spatie\Permission\Traits\HasRoles;

class UserPoint extends Model
{
    //
    use Notifiable;
    use CrudTrait;
    use HasRoles;

    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'betsys_point_info';


    /**
     * 获取point对应的用户
     * 一对一
     */
    public function user()
    {
        return $this->belongsTo('App\User','id','user_id');
    }
}
