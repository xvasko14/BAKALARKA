@extends('layouts.adminLayout.admin_design')

@section('obsah')


    <div id="content">

        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ url('/admin') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
        </div>

        <div class="container" style="max-width:80%; margin-top: 40px;">
            <form action="{{ route('admin.PlayerInGame.insertGame', $game->id) }}" method="post">
              <div class="Row" >
                  <div class="Column">
                    {{ csrf_field()}}
                    <label for="brankar"><b>Hrac 1.</b></label>
                    <select name="brankar">
                        @foreach ($players as $player)
                            <option value="{{$player->id }}">{{$player->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="Column">
                    {{ csrf_field()}}
                    <label for="goals">Pocet golov</label>
                    <input type="number" class="form-control" name="goals" placeholder="goals">
                </div>
                  <div class="Column">
                      {{ csrf_field()}}
                      <label for="asists">Pocet asistencii</label>
                      <input type="number" class="form-control" name="asists" placeholder="asists">
                  </div>
                  <div class="Column">
                      {{ csrf_field()}}
                      <label for="min">Pocet odohratych minut</label>
                      <input type="number" class="form-control" name="min" placeholder="min">
                  </div>
                <div class="Column">
                    {{ csrf_field()}}
                    <label for="yellowCard">Pocet zltych kariet</label>
                    <input type="number" class="form-control" name="yellowCard" placeholder="yellowCard">
                </div>
                <div class="Column">
                    {{ csrf_field()}}
                    <label for="redCard">Cervena karta</label>
                    <input type="number" class="form-control" name="redCard" placeholder="redCard">
                </div>
                  <div class="Column">
                      {{ csrf_field()}}
                      <label for="substitution">Striedanie</label>
                      <input type="number" class="form-control" name="substitution" placeholder="substitution">
                  </div>
                  <div class="Column">
                      {{ csrf_field()}}
                      <label for="OnBench">Nahradnik</label>
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
                        <label for="obranca1"><b>Hrac 2.</b></label>
                        <select name="obranca1">
                            @foreach ($players as $player)
                                <option value="{{$player->id }}">{{$player->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="goals1">Pocet golov</label>
                        <input type="number" class="form-control" name="goals1" placeholder="goals">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="asists1">Pocet asistencii</label>
                        <input type="number" class="form-control" name="asists1" placeholder="asists">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="min1">Pocet odohratych minut</label>
                        <input type="number" class="form-control" name="min1" placeholder="min">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="yellowCard1">Pocet zltych kariet</label>
                        <input type="number" class="form-control" name="yellowCard1" placeholder="yellowCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="redCard1">Cervena karta</label>
                        <input type="number" class="form-control" name="redCard1" placeholder="redCard">
                    </div>
                <div class="Column">
                    {{ csrf_field()}}
                    <label for="substitution1">Striedanie</label>
                    <input type="number" class="form-control" name="substitution1" placeholder="substitution">
                </div>
                <div class="Column">
                    {{ csrf_field()}}
                    <label for="OnBench1">Nahradnik</label>
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
                        <label for="obranca2"><b>Hrac 3.</b></label>
                        <select name="obranca2">
                            @foreach ($players as $player)
                                <option value="{{$player->id }}">{{$player->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="goals2">Pocet golov</label>
                        <input type="number" class="form-control" name="goals2" placeholder="goals">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="asists2">Pocet asistencii</label>
                        <input type="number" class="form-control" name="asists2" placeholder="asists">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="min2">Pocet odohratych minut</label>
                        <input type="number" class="form-control" name="min2" placeholder="min">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="yellowCard2">Pocet zltych kariet</label>
                        <input type="number" class="form-control" name="yellowCard2" placeholder="yellowCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="redCard2">Cervena karta</label>
                        <input type="number" class="form-control" name="redCard2" placeholder="redCard">
                    </div>
                <div class="Column">
                    {{ csrf_field()}}
                    <label for="substitution2">Striedanie</label>
                    <input type="number" class="form-control" name="substitution2" placeholder="substitution">
                </div>
                <div class="Column">
                    {{ csrf_field()}}
                    <label for="OnBench2">Nahradnik</label>
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
                        <label for="obranca3"><b>Hrac 4.</b></label>
                        <select name="obranca3">
                            @foreach ($players as $player)
                                <option value="{{$player->id }}">{{$player->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="goals3">Pocet golov</label>
                        <input type="number" class="form-control" name="goals3" placeholder="goals">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="asists3">Pocet asistencii</label>
                        <input type="number" class="form-control" name="asists3" placeholder="asists">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="min3">Pocet odohratych minut</label>
                        <input type="number" class="form-control" name="min3" placeholder="min">
                    </div>
                    <div class="Column">

                        {{ csrf_field()}}
                        <label for="yellowCard3">Pocet zltych kariet</label>
                        <input type="number" class="form-control" name="yellowCard3" placeholder="yellowCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="redCard3">Cervena karta</label>
                        <input type="number" class="form-control" name="redCard3" placeholder="redCard">
                    </div>
                <div class="Column">
                    {{ csrf_field()}}
                    <label for="substitution3">Striedanie</label>
                    <input type="number" class="form-control" name="substitution3" placeholder="substitution">
                </div>
                <div class="Column">
                    {{ csrf_field()}}
                    <label for="OnBench3">Nahradnik</label>
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
                    <label for="obranca"><b>Hrac 5.</b></label>
                    <select name="obranca4">
                        @foreach ($players as $player)
                            <option value="{{$player->id }}">{{$player->name }}</option>
                        @endforeach
                    </select>
                </div>

                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="goals4">Pocet golov</label>
                        <input type="number" class="form-control" name="goals4" placeholder="goals">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="asists4">Pocet asistencii</label>
                        <input type="number" class="form-control" name="asists4" placeholder="asists">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="min4">Pocet odohratych minut</label>
                        <input type="number" class="form-control" name="min4" placeholder="min">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="yellowCard4">Pocet zltych kariet</label>
                        <input type="number" class="form-control" name="yellowCard4" placeholder="yellowCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="redCard4">Cervena karta</label>
                        <input type="number" class="form-control" name="redCard4" placeholder="redCard">
                    </div>
                <div class="Column">
                    {{ csrf_field()}}
                    <label for="substitution4">Striedanie</label>
                    <input type="number" class="form-control" name="substitution4" placeholder="substitution">
                </div>
                <div class="Column">
                    {{ csrf_field()}}
                    <label for="OnBench4">Nahradnik</label>
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
                    <label for="zaloznik1"><b>Hrac 6.</b></label>
                    <select name="zaloznik1">
                        @foreach ($players as $player)
                            <option value="{{$player->id }}">{{$player->name }}</option>
                        @endforeach
                    </select>
                </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="goals5">Pocet golov</label>
                        <input type="number" class="form-control" name="goals5" placeholder="goals">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="asists5">Pocet asistencii</label>
                        <input type="number" class="form-control" name="asists5" placeholder="asists">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="min5">Pocet odohratych minut</label>
                        <input type="number" class="form-control" name="min5" placeholder="min">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="yellowCard5">Pocet zltych kariet</label>
                        <input type="number" class="form-control" name="yellowCard5" placeholder="yellowCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="redCard">Cervena karta</label>
                        <input type="number" class="form-control" name="redCard5" placeholder="redCard">
                    </div>
                <div class="Column">
                    {{ csrf_field()}}
                    <label for="substitution5">Striedanie</label>
                    <input type="number" class="form-control" name="substitution5" placeholder="substitution">
                </div>
                <div class="Column">
                    {{ csrf_field()}}
                    <label for="OnBench5">Nahradnik</label>
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
                        <label for="zaloznik2"><b>Hrac 7.</b></label>
                        <select name="zaloznik2">
                            @foreach ($players as $player)
                                <option value="{{$player->id }}">{{$player->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="goals6">Pocet golov</label>
                        <input type="number" class="form-control" name="goals6" placeholder="goals">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="asists6">Pocet asistencii</label>
                        <input type="number" class="form-control" name="asists6" placeholder="asists">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="min6">Pocet odohratych minut</label>
                        <input type="number" class="form-control" name="min6" placeholder="min">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="yellowCard6">Pocet zltych kariet</label>
                        <input type="number" class="form-control" name="yellowCard6" placeholder="yellowCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="redCard6">Cervena karta</label>
                        <input type="number" class="form-control" name="redCard6" placeholder="redCard">
                    </div>
                <div class="Column">
                    {{ csrf_field()}}
                    <label for="substitution6">Striedanie</label>
                    <input type="number" class="form-control" name="substitution6" placeholder="substitution">
                </div>
                <div class="Column">
                    {{ csrf_field()}}
                    <label for="OnBench6">Nahradnik</label>
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
                        <label for="zaloznik3"><b>Hrac 8.</b></label>
                        <select name="zaloznik3">
                            @foreach ($players as $player)
                                <option value="{{$player->id }}">{{$player->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="goals7">Pocet golov</label>
                        <input type="number" class="form-control" name="goals7" placeholder="goals">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="asists7">Pocet asistencii</label>
                        <input type="number" class="form-control" name="asists7" placeholder="asists">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="min7">Pocet odohratych minut</label>
                        <input type="number" class="form-control" name="min7" placeholder="min">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="yellowCard7">Pocet zltych kariet</label>
                        <input type="number" class="form-control" name="yellowCard7" placeholder="yellowCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="redCard7">Cervena karta</label>
                        <input type="number" class="form-control" name="redCard7" placeholder="redCard">
                    </div>
                <div class="Column">
                    {{ csrf_field()}}
                    <label for="substitution7">Striedanie</label>
                    <input type="number" class="form-control" name="substitution7" placeholder="substitution">
                </div>
                <div class="Column">
                    {{ csrf_field()}}
                    <label for="OnBench7">Nahradnik</label>
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
                        <label for="utocnik1"><b>Hrac 9.</b></label>
                        <select name="utocnik1">
                            @foreach ($players as $player)
                                <option value="{{$player->id }}">{{$player->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="goals8">Pocet golov</label>
                        <input type="number" class="form-control" name="goals8" placeholder="goals">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="asists8">Pocet asistencii</label>
                        <input type="number" class="form-control" name="asists8" placeholder="asists">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="min8">Pocet odohratych minut</label>
                        <input type="number" class="form-control" name="min8" placeholder="min">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="yellowCard8">Pocet zltych kariet</label>
                        <input type="number" class="form-control" name="yellowCard8" placeholder="yellowCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="redCard8">Cervena karta</label>
                        <input type="number" class="form-control" name="redCard8" placeholder="redCard">
                    </div>
                <div class="Column">
                    {{ csrf_field()}}
                    <label for="substitution8">Striedanie</label>
                    <input type="number" class="form-control" name="substitution8" placeholder="substitution">
                </div>
                <div class="Column">
                    {{ csrf_field()}}
                    <label for="OnBench8">Nahradnik</label>
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
                        <label for="utocnik2"><b>Hrac 10.</b></label>
                        <select name="utocnik2">
                            @foreach ($players as $player)
                                <option value="{{$player->id }}">{{$player->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="goals9">Pocet golov</label>
                        <input type="number" class="form-control" name="goals9" placeholder="goals">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="asists9">Pocet asistencii</label>
                        <input type="number" class="form-control" name="asists9" placeholder="asists">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="min9">Pocet odohratych minut</label>
                        <input type="number" class="form-control" name="min9" placeholder="min">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="yellowCard9">Pocet zltych kariet</label>
                        <input type="number" class="form-control" name="yellowCard9" placeholder="yellowCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="redCard9">Cervena karta</label>
                        <input type="number" class="form-control" name="redCard9" placeholder="redCard">
                    </div>
                <div class="Column">
                    {{ csrf_field()}}
                    <label for="substitution9">Striedanie</label>
                    <input type="number" class="form-control" name="substitution9" placeholder="substitution">
                </div>
                <div class="Column">
                    {{ csrf_field()}}
                    <label for="OnBench9">Nahradnik</label>
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
                        <label for="utocnik3"><b>Hrac 11.</b></label>
                        <select name="utocnik3">
                            @foreach ($players as $player)
                                <option value="{{$player->id }}">{{$player->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="goals10">Pocet golov</label>
                        <input type="number" class="form-control" name="goals10" placeholder="goals">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="asists10">Pocet asistencii</label>
                        <input type="number" class="form-control" name="asists10" placeholder="asists">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="min10">Pocet odohratych minut</label>
                        <input type="number" class="form-control" name="min10" placeholder="min">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="yellowCard10">Pocet zltych kariet</label>
                        <input type="number" class="form-control" name="yellowCard10" placeholder="yellowCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="redCard10">Cervena karta</label>
                        <input type="number" class="form-control" name="redCard10" placeholder="redCard">
                    </div>
                <div class="Column">
                    {{ csrf_field()}}
                    <label for="substitution10">Striedanie</label>
                    <input type="number" class="form-control" name="substitution10" placeholder="substitution">
                </div>
                <div class="Column">
                    {{ csrf_field()}}
                    <label for="OnBench10">Nahradnik</label>
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
                        <label for="nahradnik1"><b>Nahradnik 1.</b></label>
                        <select name="nahradnik1">
                            @foreach ($players as $player)
                                <option value="{{$player->id }}">{{$player->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="goals11">Pocet golov</label>
                        <input type="number" class="form-control" name="goals11" placeholder="goals">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="asists11">Pocet asistencii</label>
                        <input type="number" class="form-control" name="asists11" placeholder="asists">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="min11">Pocet odohratych minut</label>
                        <input type="number" class="form-control" name="min11" placeholder="min">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="yellowCard11">Pocet zltych kariet</label>
                        <input type="number" class="form-control" name="yellowCard11" placeholder="yellowCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="redCard11">Cervena karta</label>
                        <input type="number" class="form-control" name="redCard11" placeholder="redCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="substitution11">Striedanie</label>
                        <input type="number" class="form-control" name="substitution11" placeholder="substitution">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="OnBench11">Nahradnik</label>
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
                        <label for="nahradnik2"><b>Nahradnik 2.</b></label>
                        <select name="nahradnik2">
                            @foreach ($players as $player)
                                <option value="{{$player->id }}">{{$player->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="goals12">Pocet golov</label>
                        <input type="number" class="form-control" name="goals12" placeholder="goals">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="asists12">Pocet asistencii</label>
                        <input type="number" class="form-control" name="asists12" placeholder="asists">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="min12">Pocet odohratych minut</label>
                        <input type="number" class="form-control" name="min12" placeholder="min">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="yellowCard12">Pocet zltych kariet</label>
                        <input type="number" class="form-control" name="yellowCard12" placeholder="yellowCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="redCard12">Cervena karta</label>
                        <input type="number" class="form-control" name="redCard12" placeholder="redCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="substitution12">Striedanie</label>
                        <input type="number" class="form-control" name="substitution12" placeholder="substitution">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="OnBench12">Nahradnik</label>
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
                        <label for="nahradnik3"><b>Nahradnik 3.</b></label>
                        <select name="nahradnik3">
                            @foreach ($players as $player)
                                <option value="{{$player->id }}">{{$player->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="goals13">Pocet golov</label>
                        <input type="number" class="form-control" name="goals13" placeholder="goals">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="asists13">Pocet asistencii</label>
                        <input type="number" class="form-control" name="asists13" placeholder="asists">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="min13">Pocet odohratych minut</label>
                        <input type="number" class="form-control" name="min13" placeholder="min">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="yellowCard13">Pocet zltych kariet</label>
                        <input type="number" class="form-control" name="yellowCard13" placeholder="yellowCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="redCard13">Cervena karta</label>
                        <input type="number" class="form-control" name="redCard13" placeholder="redCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="substitution13">Striedanie</label>
                        <input type="number" class="form-control" name="substitution13" placeholder="substitution">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="OnBench13">Nahradnik</label>
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
                        <label for="nahradnik4"><b>Nahradnik 4.</b></label>
                        <select name="nahradnik4">
                            @foreach ($players as $player)
                                <option value="{{$player->id }}">{{$player->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="goals14">Pocet golov</label>
                        <input type="number" class="form-control" name="goals14" placeholder="goals">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="asists14">Pocet asistencii</label>
                        <input type="number" class="form-control" name="asists14" placeholder="asists">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="min14">Pocet odohratych minut</label>
                        <input type="number" class="form-control" name="min14" placeholder="min">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="yellowCard14">Pocet zltych kariet</label>
                        <input type="number" class="form-control" name="yellowCard14" placeholder="yellowCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="redCard14">Cervena karta</label>
                        <input type="number" class="form-control" name="redCard14" placeholder="redCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="substitution14">Striedanie</label>
                        <input type="number" class="form-control" name="substitution14" placeholder="substitution">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="OnBench14">Nahradnik</label>
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
                        <label for="goals15">Pocet golov</label>
                        <input type="number" class="form-control" name="goals15" placeholder="goals">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="asists15">Pocet asistencii</label>
                        <input type="number" class="form-control" name="asists15" placeholder="asists">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="min15">Pocet odohratych minut</label>
                        <input type="number" class="form-control" name="min15" placeholder="min">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="yellowCard15">Pocet zltych kariet</label>
                        <input type="number" class="form-control" name="yellowCard15" placeholder="yellowCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="redCard15">Cervena karta</label>
                        <input type="number" class="form-control" name="redCard15" placeholder="redCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="substitution15">Striedanie</label>
                        <input type="number" class="form-control" name="substitution15" placeholder="substitution">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="OnBench15">Nahradnik</label>
                        <input type="number" class="form-control" name="OnBench15" placeholder="bol nahradnik">
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        <br>
                    @endif

                </div>
                <button type="submit" class="btn btn-primary">Odoslať</button>
            </form>

        </div>
    </div>

@endsection
