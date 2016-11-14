<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Team extends Model
{
    use CrudTrait;
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'betsys_team_info';


}
