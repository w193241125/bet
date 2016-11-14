<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Log;
use App\Team;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //自定义验证
        Validator::extend('tm_team_id_valid', function($attribute, $value, $parameters, $validator)
        {
            //使用cookies
            $client = new Client(['cookies' => true]);
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
                //获取TM team info
                $response = $client->request('POST', config('bet.tmurl.tm_url').config('bet.tmurl.tm_team_info_url'), [
                    'form_params' => [
                        'club_id' => $value,
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
                $club = Team::where('tm_team_id',$value)->first();
                if($club == NULL)
                {
                    $club = new Team;
                }
                $club->tm_team_id = $value;
                $club->team_name = $json->club->club_name;
                $club->league = $json->club->country.'/'.$json->club->division.'/'.$json->club->group;
                $club->save();
            }
            catch(GuzzleException $e)
            {
                Log::error($e);
            }
            return True;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        if ($this->app->environment() == 'local') {
            // $this->app->register('Laracasts\Generators\GeneratorsServiceProvider'); // you're using Jeffrey way's generators, too, right?
            $this->app->register('Backpack\Generators\GeneratorsServiceProvider');
        }
    }
}
