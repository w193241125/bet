<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\UserPoint;
use App\LoginInfo;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;



class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            //bail为验证失败后停止检查属性其它验证规则，tm_team_id_valid为自定义规则，见AppServiceProvider.php
            'tm_team_id' => 'bail|required|integer|unique:users,tm_team_id|tm_team_id_valid'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $u = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'tm_team_id' => $data['tm_team_id'],
            'password' => bcrypt($data['password']),
        ]);

        //获取注册的用户id，插入point表,新用户默认100point
        $user = User::where('email',$data['email'])->firstOrFail();

        $userPoint = new UserPoint();
        $userPoint->user_id = $user->id;

        $userPoint->point = 100;
        $userPoint->save();

        //设置登录信息
        $loginInfo = new LoginInfo();
        $loginInfo->user_id = $user->id;
        $loginInfo->last_login_at = Carbon::now();
        $loginInfo->consecutive_login_days = 0;
        $loginInfo->save();

        return $u;
    }
}
