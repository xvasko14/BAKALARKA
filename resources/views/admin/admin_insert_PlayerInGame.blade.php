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
                    <label for="brankar">Hrac</label>
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
                    <label for="yellowCard">Pocet zltych kariet</label>
                    <input type="number" class="form-control" name="yellowCard" placeholder="yellowCard">
                </div>
                <div class="Column">
                    {{ csrf_field()}}
                    <label for="redCard">Cervena karta</label>
                    <input type="number" class="form-control" name="redCard" placeholder="redCard">
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
                        <label for="obranca1">Hrac</label>
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
                        <label for="yellowCard1">Pocet zltych kariet</label>
                        <input type="number" class="form-control" name="yellowCard1" placeholder="yellowCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="redCard1">Cervena karta</label>
                        <input type="number" class="form-control" name="redCard1" placeholder="redCard">
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
                        <label for="obranca2">Hrac</label>
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
                        <label for="yellowCard2">Pocet zltych kariet</label>
                        <input type="number" class="form-control" name="yellowCard2" placeholder="yellowCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="redCard2">Cervena karta</label>
                        <input type="number" class="form-control" name="redCard2" placeholder="redCard">
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
                        <label for="obranca3">Hrac</label>
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
                        <label for="yellowCard3">Pocet zltych kariet</label>
                        <input type="number" class="form-control" name="yellowCard3" placeholder="yellowCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="redCard3">Cervena karta</label>
                        <input type="number" class="form-control" name="redCard3" placeholder="redCard">
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
                    <label for="obranca">Hrac</label>
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
                        <label for="yellowCard4">Pocet zltych kariet</label>
                        <input type="number" class="form-control" name="yellowCard4" placeholder="yellowCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="redCard4">Cervena karta</label>
                        <input type="number" class="form-control" name="redCard4" placeholder="redCard">
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
                    <label for="zaloznik1">Hrac</label>
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
                        <label for="yellowCard5">Pocet zltych kariet</label>
                        <input type="number" class="form-control" name="yellowCard5" placeholder="yellowCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="redCard">Cervena karta</label>
                        <input type="number5" class="form-control" name="redCard5" placeholder="redCard">
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
                        <label for="zaloznik2">Hrac</label>
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
                        <label for="yellowCard6">Pocet zltych kariet</label>
                        <input type="number" class="form-control" name="yellowCard6" placeholder="yellowCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="redCard6">Cervena karta</label>
                        <input type="number" class="form-control" name="redCard6" placeholder="redCard">
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
                        <label for="zaloznik3">Hrac</label>
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
                        <label for="yellowCard7">Pocet zltych kariet</label>
                        <input type="number" class="form-control" name="yellowCard7" placeholder="yellowCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="redCard7">Cervena karta</label>
                        <input type="number" class="form-control" name="redCard7" placeholder="redCard">
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
                        <label for="utocnik1">Hrac</label>
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
                        <label for="yellowCard8">Pocet zltych kariet</label>
                        <input type="number" class="form-control" name="yellowCard8" placeholder="yellowCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="redCard8">Cervena karta</label>
                        <input type="number" class="form-control" name="redCard8" placeholder="redCard">
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
                        <label for="utocnik2">Hrac</label>
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
                        <label for="yellowCard9">Pocet zltych kariet</label>
                        <input type="number" class="form-control" name="yellowCard9" placeholder="yellowCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="redCard9">Cervena karta</label>
                        <input type="number" class="form-control" name="redCard9" placeholder="redCard">
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
                        <label for="utocnik3">Hrac</label>
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
                        <label for="yellowCard10">Pocet zltych kariet</label>
                        <input type="number" class="form-control" name="yellowCard10" placeholder="yellowCard">
                    </div>
                    <div class="Column">
                        {{ csrf_field()}}
                        <label for="redCard10">Cervena karta</label>
                        <input type="number" class="form-control" name="redCard10" placeholder="redCard">
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
