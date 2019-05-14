@extends('layouts.adminLayout.admin_design')

@section('obsah')


    <div id="content">

        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ url('/admin') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
        </div>

        <div class="container" style="max-width:80%; margin-top: 40px;">
            <form action="{{ route('admin.PlayerInGame.insertGame', $game->id) }}" method="post">
                <div class="okno">
                    @if (session('status'))
                        <div class="alert alert-warning alert-dismissible fade in text-center">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                      @for ($i = 0; $i < 16; $i++)

                          <div class="Row" >
                              <div class="Column">
                                  {{ csrf_field()}}
                                  <label for="row[{{$i}}][hrac]"><b>{{ __('message.Player') }} {{$i}}.</b></label>
                                  <select name="row[{{$i}}][hrac]">
                                      @foreach ($players as $player)
                                          <option value="{{$player->id }}">{{$player->name }}</option>
                                      @endforeach
                                  </select>
                              </div>
                              <div class="Column">
                                  {{ csrf_field()}}
                                  <label for="goals">{{ __('message.goals') }} </label>
                                  <input type="number" class="form-control" name="row[{{$i}}][goals]" placeholder="goals" value="0">
                              </div>
                              <div class="Column">
                                  {{ csrf_field()}}
                                  <label for="asists">{{ __('message.asists') }} </label>
                                  <input type="number" class="form-control" name="row[{{$i}}][asists]" placeholder="asists" value="0"">
                              </div>
                              <div class="Column">
                                  {{ csrf_field()}}
                                  <label for="min">{{ __('message.mins') }} </label>
                                  <input type="number" class="form-control" name="row[{{$i}}][min]" placeholder="min" value="0">
                              </div>
                              <div class="Column">
                                  {{ csrf_field()}}
                                  <label for="yellowCard">{{ __('message.yellowC') }} </label>
                                  <input type="number" class="form-control" name="row[{{$i}}][yellowCard]" placeholder="yellowCard" value="0">
                              </div>
                              <div class="Column">
                                  {{ csrf_field()}}
                                  <label for="redCard">{{ __('message.redC') }} </label>
                                  <input type="number" class="form-control" name="row[{{$i}}][redCard]" placeholder="redCard" value="0">
                              </div>
                              <div class="Column">
                                  {{ csrf_field()}}
                                  <label for="substitution">{{ __('message.substitution') }}</label>
                                  <input type="number" class="form-control" name="row[{{$i}}][substitution]" placeholder="substitution" value="0">
                              </div>
                              <div class="Column">
                                  {{ csrf_field()}}
                                  <label for="OnBench">{{ __('message.bench1') }}</label>
                                  <input type="number" class="form-control" name="row[{{$i}}][OnBench]" placeholder="bol nahradnik" value="0">
                              </div>

                          </div>
                      @endfor

    {{-- <div class="Row" >

              <div class="Column">
                  {{ csrf_field()}}
                  <label for="obranca1"><b>Hráč 2.</b></label>
                  <select name="obranca1">
                      @foreach ($players as $player)
                          <option value="{{$player->id }}">{{$player->name }}</option>
                      @endforeach
                  </select>
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="goals1">Počet gólov</label>
                  <input type="number" class="form-control" name="goals1" placeholder="goals">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="asists1">Počet asistencií</label>
                  <input type="number" class="form-control" name="asists1" placeholder="asists">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="min1">Počet odohratých minút</label>
                  <input type="number" class="form-control" name="min1" placeholder="min">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="yellowCard1">Počet žltých kariet</label>
                  <input type="number" class="form-control" name="yellowCard1" placeholder="yellowCard">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="redCard1">Počet červených kariet</label>
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
                  <label for="obranca2"><b>Hráč 3.</b></label>
                  <select name="obranca2">
                      @foreach ($players as $player)
                          <option value="{{$player->id }}">{{$player->name }}</option>
                      @endforeach
                  </select>
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="goals2">Počet gólov</label>
                  <input type="number" class="form-control" name="goals2" placeholder="goals">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="asists2">Počet asistencií</label>
                  <input type="number" class="form-control" name="asists2" placeholder="asists">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="min2">Počet odohratých minút</label>
                  <input type="number" class="form-control" name="min2" placeholder="min">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="yellowCard2">Počet žltých kariet</label>
                  <input type="number" class="form-control" name="yellowCard2" placeholder="yellowCard">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="redCard2">Počet červených kariet</label>
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
                  <label for="obranca3"><b>Hráč 4.</b></label>
                  <select name="obranca3">
                      @foreach ($players as $player)
                          <option value="{{$player->id }}">{{$player->name }}</option>
                      @endforeach
                  </select>
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="goals3">Počet gólov</label>
                  <input type="number" class="form-control" name="goals3" placeholder="goals">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="asists3">Počet asistencií</label>
                  <input type="number" class="form-control" name="asists3" placeholder="asists">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="min3">Počet odohratých minút</label>
                  <input type="number" class="form-control" name="min3" placeholder="min">
              </div>
              <div class="Column">

                  {{ csrf_field()}}
                  <label for="yellowCard3">Počet žltých kariet</label>
                  <input type="number" class="form-control" name="yellowCard3" placeholder="yellowCard">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="redCard3">Počet červených kariet</label>
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
              <label for="obranca"><b>Hráč 5.</b></label>
              <select name="obranca4">
                  @foreach ($players as $player)
                      <option value="{{$player->id }}">{{$player->name }}</option>
                  @endforeach
              </select>
          </div>

              <div class="Column">
                  {{ csrf_field()}}
                  <label for="goals4">Počet gólov</label>
                  <input type="number" class="form-control" name="goals4" placeholder="goals">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="asists4">Počet asistencií</label>
                  <input type="number" class="form-control" name="asists4" placeholder="asists">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="min4">Počet odohratých minút</label>
                  <input type="number" class="form-control" name="min4" placeholder="min">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="yellowCard4">Počet žltých kariet</label>
                  <input type="number" class="form-control" name="yellowCard4" placeholder="yellowCard">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="redCard4">Počet červených kariet</label>
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
              <label for="zaloznik1"><b>Hráč 6.</b></label>
              <select name="zaloznik1">
                  @foreach ($players as $player)
                      <option value="{{$player->id }}">{{$player->name }}</option>
                  @endforeach
              </select>
          </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="goals5">Počet gólov</label>
                  <input type="number" class="form-control" name="goals5" placeholder="goals">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="asists5">Počet asistencií</label>
                  <input type="number" class="form-control" name="asists5" placeholder="asists">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="min5">Počet odohratých minút</label>
                  <input type="number" class="form-control" name="min5" placeholder="min">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="yellowCard5">Počet žltých kariet</label>
                  <input type="number" class="form-control" name="yellowCard5" placeholder="yellowCard">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="redCard">Počet červených kariet</label>
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
                  <label for="zaloznik2"><b>Hráč 7.</b></label>
                  <select name="zaloznik2">
                      @foreach ($players as $player)
                          <option value="{{$player->id }}">{{$player->name }}</option>
                      @endforeach
                  </select>
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="goals6">Počet gólov</label>
                  <input type="number" class="form-control" name="goals6" placeholder="goals">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="asists6">Počet asistencií</label>
                  <input type="number" class="form-control" name="asists6" placeholder="asists">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="min6">Počet odohratých minút</label>
                  <input type="number" class="form-control" name="min6" placeholder="min">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="yellowCard6">Počet žltých kariet</label>
                  <input type="number" class="form-control" name="yellowCard6" placeholder="yellowCard">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="redCard6">Počet červených kariet</label>
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
                  <label for="zaloznik3"><b>Hráč 8.</b></label>
                  <select name="zaloznik3">
                      @foreach ($players as $player)
                          <option value="{{$player->id }}">{{$player->name }}</option>
                      @endforeach
                  </select>
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="goals7">Počet gólov</label>
                  <input type="number" class="form-control" name="goals7" placeholder="goals">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="asists7">Počet asistencií</label>
                  <input type="number" class="form-control" name="asists7" placeholder="asists">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="min7">Počet odohratých minút</label>
                  <input type="number" class="form-control" name="min7" placeholder="min">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="yellowCard7">Počet žltých kariet/label>
                  <input type="number" class="form-control" name="yellowCard7" placeholder="yellowCard">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="redCard7">Počet červených kariet</label>
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
                  <label for="utocnik1"><b>Hráč 9.</b></label>
                  <select name="utocnik1">
                      @foreach ($players as $player)
                          <option value="{{$player->id }}">{{$player->name }}</option>
                      @endforeach
                  </select>
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="goals8">Počet gólov/label>
                  <input type="number" class="form-control" name="goals8" placeholder="goals">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="asists8">Počet asistencií/label>
                  <input type="number" class="form-control" name="asists8" placeholder="asists">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="min8">Počet odohratých minút</label>
                  <input type="number" class="form-control" name="min8" placeholder="min">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="yellowCard8">Počet žltých kariet</label>
                  <input type="number" class="form-control" name="yellowCard8" placeholder="yellowCard">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="redCard8">Počet červených kariet</label>
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
                  <label for="utocnik2"><b>Hráč 10.</b></label>
                  <select name="utocnik2">
                      @foreach ($players as $player)
                          <option value="{{$player->id }}">{{$player->name }}</option>
                      @endforeach
                  </select>
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="goals9">Počet gólov</label>
                  <input type="number" class="form-control" name="goals9" placeholder="goals">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="asists9">Počet asistencií</label>
                  <input type="number" class="form-control" name="asists9" placeholder="asists">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="min9">Počet odohratých minút</label>
                  <input type="number" class="form-control" name="min9" placeholder="min">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="yellowCard9">Počet žltých kariet</label>
                  <input type="number" class="form-control" name="yellowCard9" placeholder="yellowCard">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="redCard9">Počet červených kariet</label>
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
                  <label for="utocnik3"><b>Hráč 11.</b></label>
                  <select name="utocnik3">
                      @foreach ($players as $player)
                          <option value="{{$player->id }}">{{$player->name }}</option>
                      @endforeach
                  </select>
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="goals10">Počet gólov</label>
                  <input type="number" class="form-control" name="goals10" placeholder="goals">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="asists10">Počet asistencií</label>
                  <input type="number" class="form-control" name="asists10" placeholder="asists">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="min10">Počet odohratých minút</label>
                  <input type="number" class="form-control" name="min10" placeholder="min">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="yellowCard10">Počet žltých kariet</label>
                  <input type="number" class="form-control" name="yellowCard10" placeholder="yellowCard">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="redCard10">Počet červených kariet</label>
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
                  <label for="goals11">Počet gólov</label>
                  <input type="number" class="form-control" name="goals11" placeholder="goals">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="asists11">Počet asistencií</label>
                  <input type="number" class="form-control" name="asists11" placeholder="asists">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="min11">Počet odohratých minút</label>
                  <input type="number" class="form-control" name="min11" placeholder="min">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="yellowCard11">Počet žltých kariet</label>
                  <input type="number" class="form-control" name="yellowCard11" placeholder="yellowCard">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="redCard11">Počet červených kariet</label>
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
                  <label for="goals12">Počet gólov</label>
                  <input type="number" class="form-control" name="goals12" placeholder="goals">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="asists12">Počet asistencií</label>
                  <input type="number" class="form-control" name="asists12" placeholder="asists">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="min12">Počet odohratých minút</label>
                  <input type="number" class="form-control" name="min12" placeholder="min">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="yellowCard12">Počet žltých kariet</label>
                  <input type="number" class="form-control" name="yellowCard12" placeholder="yellowCard">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="redCard12">Počet červených kariet</label>
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
                  <label for="goals13">Počet gólov</label>
                  <input type="number" class="form-control" name="goals13" placeholder="goals">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="asists13">Počet asistencií</label>
                  <input type="number" class="form-control" name="asists13" placeholder="asists">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="min13">Počet odohratých minút</label>
                  <input type="number" class="form-control" name="min13" placeholder="min">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="yellowCard13">Počet žltých kariet/label>
                  <input type="number" class="form-control" name="yellowCard13" placeholder="yellowCard">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="redCard13">Počet červených kariet</label>
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
                  <label for="goals14">Počet gólov</label>
                  <input type="number" class="form-control" name="goals14" placeholder="goals">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="asists14">Počet asistencií</label>
                  <input type="number" class="form-control" name="asists14" placeholder="asists">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="min14">Počet odohratých minút</label>
                  <input type="number" class="form-control" name="min14" placeholder="min">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="yellowCard14">Počet žltých kariet/label>
                  <input type="number" class="form-control" name="yellowCard14" placeholder="yellowCard">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="redCard14">Počet červených kariet</label>
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
                  <label for="goals15">Počet gólov</label>
                  <input type="number" class="form-control" name="goals15" placeholder="goals">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="asists15">Počet asistencií</label>
                  <input type="number" class="form-control" name="asists15" placeholder="asists">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="min15">Počet odohratých minút</label>
                  <input type="number" class="form-control" name="min15" placeholder="min">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="yellowCard15">Počet žltých kariet</label>
                  <input type="number" class="form-control" name="yellowCard15" placeholder="yellowCard">
              </div>
              <div class="Column">
                  {{ csrf_field()}}
                  <label for="redCard15">Počet červených kariet</label>
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
--}}
           <div class="wrapper">
          <button type="submit" class="btn btn-primary">Odoslať</button>
           </div>
      </form>

  </div>
</div>

@endsection
