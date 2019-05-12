@extends('layouts.mainLayout.manager_layout')

@section('content')

    <div id="content">

        <div class="container" style="max-width:80%; margin-top: 40px;">
            <form action="{{ route('manager.PlayerInGame.insertGame', $game->id) }}" method="post">
                <div class="Row" >
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="brankar"><b>{{ __('message.Player') }} 1.</b></label>
                        <select name="brankar">
                            @foreach ($players as $player)
                                <option value="{{$player->id }}">{{$player->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="goals">{{ __('message.goals') }} </label>
                        <input type="number" class="form-control" name="goals" placeholder="goals">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="asists">{{ __('message.asists') }} </label>
                        <input type="number" class="form-control" name="asists" placeholder="asists">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="min">{{ __('message.mins') }} </label>
                        <input type="number" class="form-control" name="min" placeholder="min">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="yellowCard">{{ __('message.yellowC') }} </label>
                        <input type="number" class="form-control" name="yellowCard" placeholder="yellowCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="redCard">{{ __('message.redC') }} </label>
                        <input type="number" class="form-control" name="redCard" placeholder="redCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="substitution">{{ __('message.substitution') }}</label>
                        <input type="number" class="form-control" name="substitution" placeholder="substitution">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="OnBench">{{ __('message.bench1') }}</label>
                        <input type="number" class="form-control" name="OnBench" placeholder="bol nahradnik">
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        <br>
                    @endif
                </div>

                <div class="Row" >

                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="obranca1"><b>{{ __('message.Player') }}  2.</b></label>
                        <select name="obranca1">
                            @foreach ($players as $player)
                                <option value="{{$player->id }}">{{$player->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="goals1">{{ __('message.goals') }}</label>
                        <input type="number" class="form-control" name="goals1" placeholder="goals">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="asists1">{{ __('message.asists') }}</label>
                        <input type="number" class="form-control" name="asists1" placeholder="asists">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="min1">{{ __('message.mins') }}</label>
                        <input type="number" class="form-control" name="min1" placeholder="min">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="yellowCard1">{{ __('message.yellowC') }}</label>
                        <input type="number" class="form-control" name="yellowCard1" placeholder="yellowCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="redCard1">{{ __('message.redC') }}</label>
                        <input type="number" class="form-control" name="redCard1" placeholder="redCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="substitution1">{{ __('message.substitution') }}</label>
                        <input type="number" class="form-control" name="substitution1" placeholder="substitution">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="OnBench1">{{ __('message.bench1') }}</label>
                        <input type="number" class="form-control" name="OnBench1" placeholder="bol nahradnik">
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        <br>
                    @endif

                </div>
                <div class="Row" >

                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="obranca2"><b>{{ __('message.Player') }} 3.</b></label>
                        <select name="obranca2">
                            @foreach ($players as $player)
                                <option value="{{$player->id }}">{{$player->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="goals2">{{ __('message.goals') }} </label>
                        <input type="number" class="form-control" name="goals2" placeholder="goals">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="asists2">{{ __('message.asists') }}</label>
                        <input type="number" class="form-control" name="asists2" placeholder="asists">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="min2">{{ __('message.mins') }}</label>
                        <input type="number" class="form-control" name="min2" placeholder="min">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="yellowCard2">{{ __('message.yellowC') }}</label>
                        <input type="number" class="form-control" name="yellowCard2" placeholder="yellowCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="redCard2">{{ __('message.redC') }}</label>
                        <input type="number" class="form-control" name="redCard2" placeholder="redCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="substitution2">{{ __('message.substitution') }}</label>
                        <input type="number" class="form-control" name="substitution2" placeholder="substitution">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="OnBench2">{{ __('message.bench1') }}</label>
                        <input type="number" class="form-control" name="OnBench2" placeholder="bol nahradnik">
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        <br>
                    @endif

                </div>
                <div class="Row" >

                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="obranca3"><b>{{ __('message.Player') }} 4.</b></label>
                        <select name="obranca3">
                            @foreach ($players as $player)
                                <option value="{{$player->id }}">{{$player->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="goals3">{{ __('message.goals') }} </label>
                        <input type="number" class="form-control" name="goals3" placeholder="goals">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="asists3">{{ __('message.asists') }}</label>
                        <input type="number" class="form-control" name="asists3" placeholder="asists">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="min3">{{ __('message.mins') }}</label>
                        <input type="number" class="form-control" name="min3" placeholder="min">
                    </div>
                    <div class="Column">

                        {{ csrf_field()}}
                        <label for="yellowCard3">{{ __('message.yellowC') }}</label>
                        <input type="number" class="form-control" name="yellowCard3" placeholder="yellowCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="redCard3">{{ __('message.redC') }}</label>
                        <input type="number" class="form-control" name="redCard3" placeholder="redCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="substitution3">{{ __('message.substitution') }}</label>
                        <input type="number" class="form-control" name="substitution3" placeholder="substitution">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="OnBench3">{{ __('message.bench1') }}</label>
                        <input type="number" class="form-control" name="OnBench3" placeholder="bol nahradnik">
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        <br>
                    @endif

                </div>
                <div class="Row" >

                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="obranca"><b>{{ __('message.Player') }} 5.</b></label>
                        <select name="obranca4">
                            @foreach ($players as $player)
                                <option value="{{$player->id }}">{{$player->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="goals4">{{ __('message.goals') }} </label>
                        <input type="number" class="form-control" name="goals4" placeholder="goals">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="asists4">{{ __('message.asists') }}</label>
                        <input type="number" class="form-control" name="asists4" placeholder="asists">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="min4">{{ __('message.mins') }}</label>
                        <input type="number" class="form-control" name="min4" placeholder="min">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="yellowCard4">{{ __('message.yellowC') }}</label>
                        <input type="number" class="form-control" name="yellowCard4" placeholder="yellowCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="redCard4">{{ __('message.redC') }}</label>
                        <input type="number" class="form-control" name="redCard4" placeholder="redCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="substitution4">{{ __('message.substitution') }}</label>
                        <input type="number" class="form-control" name="substitution4" placeholder="substitution">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="OnBench4">{{ __('message.bench1') }}</label>
                        <input type="number" class="form-control" name="OnBench4" placeholder="bol nahradnik">
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        <br>
                    @endif

                </div>
                <div class="Row" >

                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="zaloznik1"><b>{{ __('message.Player') }} 6.</b></label>
                        <select name="zaloznik1">
                            @foreach ($players as $player)
                                <option value="{{$player->id }}">{{$player->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="goals5">{{ __('message.goals') }} </label>
                        <input type="number" class="form-control" name="goals5" placeholder="goals">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="asists5">{{ __('message.asists') }}</label>
                        <input type="number" class="form-control" name="asists5" placeholder="asists">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="min5">{{ __('message.mins') }}</label>
                        <input type="number" class="form-control" name="min5" placeholder="min">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="yellowCard5">{{ __('message.yellowC') }}</label>
                        <input type="number" class="form-control" name="yellowCard5" placeholder="yellowCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="redCard">{{ __('message.redC') }}</label>
                        <input type="number" class="form-control" name="redCard5" placeholder="redCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="substitution5">{{ __('message.substitution') }}</label>
                        <input type="number" class="form-control" name="substitution5" placeholder="substitution">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="OnBench5">{{ __('message.bench1') }}</label>
                        <input type="number" class="form-control" name="OnBench5" placeholder="bol nahradnik">
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        <br>
                    @endif

                </div>
                <div class="Row" >

                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="zaloznik2"><b>{{ __('message.Player') }} 7.</b></label>
                        <select name="zaloznik2">
                            @foreach ($players as $player)
                                <option value="{{$player->id }}">{{$player->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="goals6">{{ __('message.goals') }} </label>
                        <input type="number" class="form-control" name="goals6" placeholder="goals">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="asists6">{{ __('message.asists') }}</label>
                        <input type="number" class="form-control" name="asists6" placeholder="asists">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="min6">{{ __('message.mins') }}</label>
                        <input type="number" class="form-control" name="min6" placeholder="min">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="yellowCard6">{{ __('message.yellowC') }}</label>
                        <input type="number" class="form-control" name="yellowCard6" placeholder="yellowCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="redCard6">{{ __('message.redC') }}</label>
                        <input type="number" class="form-control" name="redCard6" placeholder="redCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="substitution6">{{ __('message.substitution') }}</label>
                        <input type="number" class="form-control" name="substitution6" placeholder="substitution">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="OnBench6">{{ __('message.bench1') }}</label>
                        <input type="number" class="form-control" name="OnBench6" placeholder="bol nahradnik">
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        <br>
                    @endif
                </div>
                <div class="Row" >

                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="zaloznik3"><b>{{ __('message.Player') }} 8.</b></label>
                        <select name="zaloznik3">
                            @foreach ($players as $player)
                                <option value="{{$player->id }}">{{$player->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="goals7">{{ __('message.goals') }} </label>
                        <input type="number" class="form-control" name="goals7" placeholder="goals">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="asists7">{{ __('message.asists') }}</label>
                        <input type="number" class="form-control" name="asists7" placeholder="asists">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="min7">{{ __('message.mins') }}</label>
                        <input type="number" class="form-control" name="min7" placeholder="min">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="yellowCard7">{{ __('message.yellowC') }}</label>
                        <input type="number" class="form-control" name="yellowCard7" placeholder="yellowCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="redCard7">{{ __('message.redC') }}</label>
                        <input type="number" class="form-control" name="redCard7" placeholder="redCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="substitution7">{{ __('message.substitution') }}</label>
                        <input type="number" class="form-control" name="substitution7" placeholder="substitution">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="OnBench7">{{ __('message.bench1') }}</label>
                        <input type="number" class="form-control" name="OnBench7" placeholder="bol nahradnik">
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        <br>
                    @endif

                </div>
                <div class="Row" >

                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="utocnik1"><b>{{ __('message.Player') }} 9.</b></label>
                        <select name="utocnik1">
                            @foreach ($players as $player)
                                <option value="{{$player->id }}">{{$player->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="goals8">{{ __('message.goals') }} </label>
                        <input type="number" class="form-control" name="goals8" placeholder="goals">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="asists8">{{ __('message.asists') }}</label>
                        <input type="number" class="form-control" name="asists8" placeholder="asists">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="min8">{{ __('message.mins') }}</label>
                        <input type="number" class="form-control" name="min8" placeholder="min">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="yellowCard8">{{ __('message.yellowC') }}</label>
                        <input type="number" class="form-control" name="yellowCard8" placeholder="yellowCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="redCard8">{{ __('message.redC') }}</label>
                        <input type="number" class="form-control" name="redCard8" placeholder="redCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="substitution8">{{ __('message.substitution') }}/label>
                        <input type="number" class="form-control" name="substitution8" placeholder="substitution">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="OnBench8">{{ __('message.bench1') }}</label>
                        <input type="number" class="form-control" name="OnBench8" placeholder="bol nahradnik">
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        <br>
                    @endif

                </div>
                <div class="Row" >

                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="utocnik2"><b>{{ __('message.Player') }} 10.</b></label>
                        <select name="utocnik2">
                            @foreach ($players as $player)
                                <option value="{{$player->id }}">{{$player->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="goals9">{{ __('message.goals') }} </label>
                        <input type="number" class="form-control" name="goals9" placeholder="goals">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="asists9">{{ __('message.asists') }}</label>
                        <input type="number" class="form-control" name="asists9" placeholder="asists">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="min9">{{ __('message.mins') }}</label>
                        <input type="number" class="form-control" name="min9" placeholder="min">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="yellowCard9">{{ __('message.yellowC') }}</label>
                        <input type="number" class="form-control" name="yellowCard9" placeholder="yellowCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="redCard9">{{ __('message.redC') }}</label>
                        <input type="number" class="form-control" name="redCard9" placeholder="redCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="substitution9">{{ __('message.substitution') }}</label>
                        <input type="number" class="form-control" name="substitution9" placeholder="substitution">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="OnBench9">{{ __('message.bench1') }}</label>
                        <input type="number" class="form-control" name="OnBench9" placeholder="bol nahradnik">
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        <br>
                    @endif
                </div>
                <div class="Row" >
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="utocnik3"><b>{{ __('message.Player') }}11.</b></label>
                        <select name="utocnik3">
                            @foreach ($players as $player)
                                <option value="{{$player->id }}">{{$player->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="goals10">{{ __('message.goals') }} </label>
                        <input type="number" class="form-control" name="goals10" placeholder="goals">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="asists10">{{ __('message.asists') }}</label>
                        <input type="number" class="form-control" name="asists10" placeholder="asists">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="min10">{{ __('message.mins') }}</label>
                        <input type="number" class="form-control" name="min10" placeholder="min">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="yellowCard10">{{ __('message.yellowC') }}</label>
                        <input type="number" class="form-control" name="yellowCard10" placeholder="yellowCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="redCard10">{{ __('message.redC') }}</label>
                        <input type="number" class="form-control" name="redCard10" placeholder="redCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="substitution10">{{ __('message.substitution') }}</label>
                        <input type="number" class="form-control" name="substitution10" placeholder="substitution">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="OnBench10">{{ __('message.bench1') }}</label>
                        <input type="number" class="form-control" name="OnBench10" placeholder="bol nahradnik">
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        <br>
                    @endif

                </div>
                <div class="Row" >
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="nahradnik1"><b>N{{ __('message.bench1') }} 1.</b></label>
                        <select name="nahradnik1">
                            @foreach ($players as $player)
                                <option value="{{$player->id }}">{{$player->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="goals11">{{ __('message.goals') }} </label>
                        <input type="number" class="form-control" name="goals11" placeholder="goals">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="asists11">{{ __('message.asists') }}</label>
                        <input type="number" class="form-control" name="asists11" placeholder="asists">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="min11">{{ __('message.mins') }}</label>
                        <input type="number" class="form-control" name="min11" placeholder="min">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="yellowCard11">{{ __('message.yellowC') }}</label>
                        <input type="number" class="form-control" name="yellowCard11" placeholder="yellowCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="redCard11">{{ __('message.redC') }}/label>
                        <input type="number" class="form-control" name="redCard11" placeholder="redCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="substitution11">{{ __('message.substitution') }}</label>
                        <input type="number" class="form-control" name="substitution11" placeholder="substitution">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="OnBench11">{{ __('message.bench1') }}</label>
                        <input type="number" class="form-control" name="OnBench11" placeholder="bol nahradnik">
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        <br>
                    @endif

                </div>
                <div class="Row" >
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="nahradnik2"><b>{{ __('message.bench1') }} 2.</b></label>
                        <select name="nahradnik2">
                            @foreach ($players as $player)
                                <option value="{{$player->id }}">{{$player->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="goals12">{{ __('message.goals') }} </label>
                        <input type="number" class="form-control" name="goals12" placeholder="goals">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="asists12">{{ __('message.asists') }}</label>
                        <input type="number" class="form-control" name="asists12" placeholder="asists">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="min12">{{ __('message.mins') }}</label>
                        <input type="number" class="form-control" name="min12" placeholder="min">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="yellowCard12">{{ __('message.yellowC') }}</label>
                        <input type="number" class="form-control" name="yellowCard12" placeholder="yellowCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="redCard12">{{ __('message.redC') }}</label>
                        <input type="number" class="form-control" name="redCard12" placeholder="redCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="substitution12">{{ __('message.substitution') }}</label>
                        <input type="number" class="form-control" name="substitution12" placeholder="substitution">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="OnBench12">{{ __('message.bench1') }}</label>
                        <input type="number" class="form-control" name="OnBench12" placeholder="bol nahradnik">
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        <br>
                    @endif

                </div>
                <div class="Row" >
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="nahradnik3"><b>{{ __('message.bench1') }}3.</b></label>
                        <select name="nahradnik3">
                            @foreach ($players as $player)
                                <option value="{{$player->id }}">{{$player->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="goals13">{{ __('message.goals') }} </label>
                        <input type="number" class="form-control" name="goals13" placeholder="goals">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="asists13">{{ __('message.asists') }}</label>
                        <input type="number" class="form-control" name="asists13" placeholder="asists">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="min13">{{ __('message.mins') }}</label>
                        <input type="number" class="form-control" name="min13" placeholder="min">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="yellowCard13">{{ __('message.yellowC') }}</label>
                        <input type="number" class="form-control" name="yellowCard13" placeholder="yellowCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="redCard13">{{ __('message.redC') }}</label>
                        <input type="number" class="form-control" name="redCard13" placeholder="redCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="substitution13">{{ __('message.substitution') }}</label>
                        <input type="number" class="form-control" name="substitution13" placeholder="substitution">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="OnBench13">{{ __('message.bench1') }}k</label>
                        <input type="number" class="form-control" name="OnBench13" placeholder="bol nahradnik">
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        <br>
                    @endif

                </div>
                <div class="Row" >
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="nahradnik4"><b>{{ __('message.bench1') }} 4.</b></label>
                        <select name="nahradnik4">
                            @foreach ($players as $player)
                                <option value="{{$player->id }}">{{$player->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="goals14">{{ __('message.goals') }} </label>
                        <input type="number" class="form-control" name="goals14" placeholder="goals">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="asists14">{{ __('message.asists') }}</label>
                        <input type="number" class="form-control" name="asists14" placeholder="asists">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="min14">{{ __('message.mins') }}</label>
                        <input type="number" class="form-control" name="min14" placeholder="min">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="yellowCard14">{{ __('message.yellowC') }}</label>
                        <input type="number" class="form-control" name="yellowCard14" placeholder="yellowCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="redCard14">{{ __('message.redC') }}</label>
                        <input type="number" class="form-control" name="redCard14" placeholder="redCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="substitution14">{{ __('message.substitution') }}</label>
                        <input type="number" class="form-control" name="substitution14" placeholder="substitution">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="OnBench14">{{ __('message.bench1') }}</label>
                        <input type="number" class="form-control" name="OnBench14" placeholder="bol nahradnik">
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        <br>
                    @endif

                </div>
                <div class="Row" >
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="nahradnik5"><b>Nahradnik 5.</b></label>
                        <select name="nahradnik5">
                            @foreach ($players as $player)
                                <option value="{{$player->id }}">{{$player->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="goals15">{{ __('message.goals') }} </label>
                        <input type="number" class="form-control" name="goals15" placeholder="goals">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="asists15">P{{ __('message.asists') }}</label>
                        <input type="number" class="form-control" name="asists15" placeholder="asists">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="min15">{{ __('message.mins') }}</label>
                        <input type="number" class="form-control" name="min15" placeholder="min">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="yellowCard15">{{ __('message.yellowC') }}</label>
                        <input type="number" class="form-control" name="yellowCard15" placeholder="yellowCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="redCard15">{{ __('message.redC') }}</label>
                        <input type="number" class="form-control" name="redCard15" placeholder="redCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="substitution15">{{ __('message.substitution') }}</label>
                        <input type="number" class="form-control" name="substitution15" placeholder="substitution">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="OnBench15">{{ __('message.bench1') }}</label>
                        <input type="number" class="form-control" name="OnBench15" placeholder="bol nahradnik">
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        <br>
                    @endif

                </div>
             <div class="wrapper">
                <button type="submit" class="btn btn-primary">{{ __('message.send') }}</button>
             </div>
            </form>
        </div>
        </div>
    </div>

@endsection
