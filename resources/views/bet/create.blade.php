@extends('layouts.app')

@section('content')
    <ul class="nav nav-tabs" role="tablist" id="betCreateTab">
        <li role="presentation" class="active"><a href="#tmLeagueMatch" role="tab" data-toggle="tab">添加单场TM联赛</a></li>
        <li role="presentation"><a href="#tmLeague" role="tab" data-toggle="tab">添加本轮联赛全部比赛</a></li>
        <li role="presentation"><a href="#tmCupMatch" role="tab" data-toggle="tab">添加单场TM杯赛</a></li>
        <li role="presentation"><a href="#diyMatch" role="tab" data-toggle="tab">添加其他自定义比赛</a></li>
    </ul>

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="tmLeagueMatch">homehomehomehome</div>
        <div role="tabpanel" class="tab-pane" id="tmLeague">profileprofileprofileprofile</div>
        <div role="tabpanel" class="tab-pane" id="tmCupMatch">messagesmessages</div>
        <div role="tabpanel" class="tab-pane" id="diyMatch">settingssettingsv</div>
    </div>

    <script>
        $(function () {

        })
    </script>
@endsection