@extends('layouts.mainLayout.manager_layout')

@section('content')

    <div class="container" style="max-width:90%;">

        <div class="row">
            <form class="form-inline" action="{{ route('manager_trainingPlayers.main',$teamID)}}" method="get">
                <div class="form-group">
                    {{ csrf_field()}}
                    <input type="text" class="form-control" name="search" placeholder="Meno hráča">
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit">Vyhľadať</button>
                </div>
            </form>

                    <h1 class="NadpisTabulky" align="center">Hraci na treningu</h1>

                    <div class="panel-heading">
                        <div class="">

                            <table id="rooms-table" class="table table-bordered table-striped table-condensed" border=1 width="400">
                                <thead>
                                <tr>
                                    <td colspan="2"  ><span style="color:red"style="font-weight:bold">Zameranie treningu:</span></td>
                                    <td colspan="2" style="text-align: center" >{{$content_of_training}}</td>

                                </tr>
                                <tr>
                                    <th>Hraci</th>
                                    <th>Vek</th>
                                    <th>Pozicia</th>
                                    <th>Potvrdit ucast na treningu</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($players as $player)
                                    <tr>
                                        @if ($player->training_parcipitation)
                                            <td id="kolonka_green" >{{$player->name}}</td>
                                        @else
                                            <td id="kolonka_red" >{{$player->name}}</td>
                                        @endif
                                        <td>{{\Carbon\Carbon::parse($player->date_of_birth)->diff(\Carbon\Carbon::now())->format('%y ')}}</td>
                                        <td>{{$player->position}}</td>
                                            <td><button id="green" onclick="location.href='{{route('manager_training.in', $player->id)}}'"> Zucastneny</button></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $players->links() }}


                        </div>
                    </div>

        </div>
    </div>


@endsection