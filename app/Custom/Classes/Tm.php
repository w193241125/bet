<?php
namespace App\Custom\Classes;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Log;
use App\Team;

class Tm
{
    //登录
    public function tmLogin($client)
    {
        try
        {
            //模拟登录tm
            $response = $client->request('POST', config('bet.tmurl.tm_url').config('bet.tmurl.tm_login_url'), [
                'form_params' => [
                    'user' => config('bet.tmacount.user'),
                    'password' => config('bet.tmacount.password'),
                ]
            ]);
            $json = json_decode($response->getBody());
            if($json->success === False)
            {
                Log::error('TM Acount Login Fail！');
                abort('500','与TM服务器连接失败，请与管理员联系！');
            }
        }
        catch(GuzzleException $e)
        {
            Log::error($e);
        }
    }
    /*
     * 验证tm team id 是否存在且非预备队
     * 存在且为主队返回true
     * 否则返回false
     */
    public function tmTeamIdValid($teamId)
    {
        //使用cookies
        $client = new Client(['cookies' => true]);
        $this->tmLogin($client);
        try
        {
            //获取TM team info
            $response = $client->request('POST', config('bet.tmurl.tm_url').config('bet.tmurl.tm_team_info_url'), [
                'form_params' => [
                    'club_id' => $teamId,
                ]
            ]);
            $json = json_decode($response->getBody());


            //验证是否存在此ID
            if($json->club->status == NULL)
            {
                return False;
            }

            //如果有主队则验证失败
            if($json->club->main_team !== '')
            {
                return False;
            }

            //判断是否存在此id的球队,如果没有就创建一个
            $club = Team::where('tm_team_id',$teamId)->first();
            if($club == NULL)
            {
                $club = new Team;
            }
            $club->tm_team_id = $teamId;
            $club->team_name = $json->club->club_name;
            $club->league = $json->club->country.'/'.$json->club->division.'/'.$json->club->group;
            $club->save();
        }
        catch(GuzzleException $e)
        {
            Log::error($e);
        }
        return True;
    }

    /*
     * 验证比赛是否存在，且还未到截至时间
     *
     */
    public function tmMatchIdValid($url)
    {
        $client = new Client(['cookies' => true]);
        $this->tmLogin($client);
        try
        {
            $matchId = $this->getMatchId($url);
            //获取TM match info
            $response = $client->request('GET', config('bet.tmurl.tm_url').config('bet.tmurl.tm_match_info_url').'?id='.$matchId);
            $json = json_decode($response->getBody());

            //判断比赛是否已经开赛,如果prematch存在表示未开赛,report为空表示此比赛不存在
            if(isset($json->prematch)&&$json->report!==Null)
            {
                //距离开始时间不可小于规定时间
                if(abs($json->prematch)>config('bet.bet.deadline_time'))
                    return True;
            }
        }
        catch(GuzzleException $e)
        {
            Log::error($e);
        }
        return False;
    }

    /*
     * 通过提交的url获取比赛信息
     * 返回json对象
     */
    public function matchInfo($url)
    {
        $client = new Client(['cookies' => true]);
        $this->tmLogin($client);
        try
        {
            $matchId = $this->getMatchId($url);
            //获取TM match info
            $response = $client->request('GET', config('bet.tmurl.tm_url').config('bet.tmurl.tm_match_info_url').'?id='.$matchId);
            $json = json_decode($response->getBody());
        }
        catch(GuzzleException $e)
        {
            Log::error($e);
            abort('500','获取比赛信息出错！');
        }
        //添加比赛id进入json
        $json->match_id = $matchId;
        return $json;
    }

    //从提交的字符串里取出match id
    public function  getMatchId($url)
    {
        //获取提内容中最后一段数字
        $pattern = '/\d+\/?$/';
        preg_match($pattern, $url, $matches);
        //如果最后一位是/，则去掉/
        if(substr($matches[0],-1) == '/')
        {
            $matches[0] = substr($matches[0],0,-1);
        }
        return $matches[0];
    }

    /*
     * 添加比赛，默认各种赔率为2
     *  matchInfo 为json 对象
     */
    public function storeMatch($matchInfo,$winOdds = 2,$drawOdds = 2,$loseOdds = 2)
    {
        if($matchInfo !== Null)
        {
            var_dump($matchInfo);
        }
        else
        {
            Log::error('the match info is null when admin add a match');
            abort('500','未能获取到相关比赛信息！');
        }
    }

}