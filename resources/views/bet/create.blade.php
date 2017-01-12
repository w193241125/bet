@extends('layouts.app')

@section('content')
    <ul class="nav nav-tabs" role="tablist" id="betCreateTab">
        <li role="presentation" class="active"><a href="#tmMatch" role="tab" data-toggle="tab">单场TM比赛</a></li>
        <li role="presentation"><a href="#tmLeague" role="tab" data-toggle="tab">本轮联赛全部比赛</a></li>
        <li role="presentation"><a href="#customMatch" role="tab" data-toggle="tab">自定义比赛</a></li>
    </ul>

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="tmMatch">
            <div class="panel panel-default">
                <div class="panel-heading">Add TM Match</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/bet') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="addType" value="tmMatch">
                        <div class="form-group{{ $errors->has('tmMatchId') ? ' has-error' : '' }}">
                            <label for="tmMatchId" class="col-md-4 control-label">TM Match ID</label>
                            <div class="col-md-6">
                                <input id="tmMatchId" type="text" class="form-control" name="tmMatchId" value="{{ old('tmMatchId') }}" required>

                                @if ($errors->has('tmMatchId'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tmMatchId') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Add Match
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="tmLeague">
            <div class="panel panel-default">
                <div class="panel-heading">Add TM League Match</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/bet') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="addType" value="tmLeague">
                        <div class="form-group{{ $errors->has('division') ? ' has-error' : '' }}">
                            <label for="division" class="col-md-4 control-label">Division</label>
                            <div class="col-md-6">
                                <input id="division" type="text" class="form-control" name="division" value="{{ old('division') }}" required>

                                @if ($errors->has('division'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('division') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('group') ? ' has-error' : '' }}">
                            <label for="group" class="col-md-4 control-label">Group</label>
                            <div class="col-md-6">
                                <input id="group" type="text" class="form-control" name="group" value="{{ old('group') }}" required>

                                @if ($errors->has('group'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('group') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Add Match
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div role="tabpanel" class="tab-pane" id="customMatch">
            <div class="panel panel-default">
                    <div class="panel-heading">Add Custom Match</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/bet') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="addType" value="custom">
                        <div class="form-group{{ $errors->has('homeName') ? ' has-error' : '' }}">
                            <label for="homeName" class="col-md-4 control-label">Home Name</label>

                            <div class="col-md-6">
                                <input id="homeName" type="text" class="form-control" name="homeName" value="{{ old('homeName') }}" required>

                                @if ($errors->has('homeName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('homeName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('awayName') ? ' has-error' : '' }}">
                            <label for="awayName" class="col-md-4 control-label">Away Name</label>

                            <div class="col-md-6">
                                <input id="awayName" type="text" class="form-control" name="awayName" value="{{ old('awayName') }}" required>

                                @if ($errors->has('awayName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('awayName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('fixture') ? ' has-error' : '' }}">
                            <label for="fixture" class="col-md-4 control-label">Fixture</label>

                            <div class="col-md-6">
                                <input id="fixture" type="text" class="form-control" name="fixture" value="{{ old('fixture') }}" required>

                                @if ($errors->has('fixture'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fixture') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('startBetTime') ? ' has-error' : '' }}">
                            <label for="startBetTime" class="col-md-4 control-label">Start Bet Time</label>

                            <div class="col-md-6">
                                <input id="startBetTime" type="text" class="form-control" name="startBetTime" required>

                                @if ($errors->has('startBetTime'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('startBetTime') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('deadline') ? ' has-error' : '' }}">
                            <label for="deadline" class="col-md-4 control-label">Dead Line</label>

                            <div class="col-md-6">
                                <input id="deadline" type="text" class="form-control" name="deadline" required>

                                @if ($errors->has('deadline'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('deadline') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('winOdds') ? ' has-error' : '' }}">
                            <label for="winOdds" class="col-md-4 control-label">Win Odds</label>

                            <div class="col-md-6">
                                <input id="winOdds" type="text" class="form-control" name="winOdds" required>

                                @if ($errors->has('winOdds'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('winOdds') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('drawOdds') ? ' has-error' : '' }}">
                            <label for="drawOdds" class="col-md-4 control-label">Draw Odds</label>

                            <div class="col-md-6">
                                <input id="drawOdds" type="text" class="form-control" name="drawOdds" required>

                                @if ($errors->has('drawOdds'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('drawOdds') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('loseOdds') ? ' has-error' : '' }}">
                            <label for="loseOdds" class="col-md-4 control-label">Lose Odds</label>

                            <div class="col-md-6">
                                <input id="loseOdds" type="text" class="form-control" name="loseOdds" required>

                                @if ($errors->has('loseOdds'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('loseOdds') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Add Match
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    @parent
    if($(".has-error").length)
    {
        $('.active').removeClass('active');
    }
    $('.has-error').parent().parent().parent().parent().addClass('active');
@endsection


