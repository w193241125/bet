<?php

namespace App;

use Carbon\Carbon;
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

    //自定义主键
    protected $primaryKey = 'user_id';
    //使用非自增主键
    public $incrementing = false;

    public function __construct()
    {
        parent::__construct();
        $this->last_sign_at = Carbon::now();
        $this->consecutive_sign_days = 0;
        $this->point = 0;
    }


    /**
     * 获取point对应的用户
     * 一对一
     */
    public function user()
    {
        return $this->belongsTo('App\User','id','user_id');
    }
}
