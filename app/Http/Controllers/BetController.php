<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMatchPost;
use Illuminate\Http\Request;
use Log;
use Tm;

class BetController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //必须登录，除了index方法
        $this->middleware('auth')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('bet.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bet.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * see app/requests/storeMatchPost.php
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMatchPost $request)
    {
        //提交类型
        $addType = $request->input('addType');

        switch ($addType)
        {
            case 'tmMatch':
                $winOdds = $request->input('winOdds');
                $drawOdds = $request->input('drawOdds');
                $loseOdds = $request->input('loseOdds');
                $tmMatchId = $request->input('tmMatchId');
                $tmMatchId = Tm::getMatchId($tmMatchId);
                $matchInfo = Tm::matchInfo($tmMatchId);
                Tm::storeMatch($matchInfo,$winOdds,$drawOdds,$loseOdds);
                break;
            case 'tmLeague':
                break;
            case 'customMatch':
                break;
            default:
                Log::error('Add match without type！');
                abort('500','添加tm比赛但未指定类型！');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
