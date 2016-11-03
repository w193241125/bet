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
    protected $table = ' 	betsys_point_info';

    protected $user_id,$point;
}
