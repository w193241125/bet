<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatchResult extends Model
{
    /**
     * ������ģ�͵����ݱ�
     *
     * @var string
     */
    protected $table = 'betsys_match_result';

    /**
     * ��ȡresult��Ӧ��match
     * һ��һ
     */
    public function match()
    {
        return $this->belongsTo('App\match','match_id','match_id');
    }

}
