<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    //
    /**
     * ������ģ�͵����ݱ�
     *
     * @var string
     */
    protected $table = 'betsys_match_info';

    /**
     * ��ȡ�����Ľ��
     * һ��һ
     */
    public function matchResult()
    {
        return $this->hasOne('App\MatchResult','match_id','match_id');
    }


}
