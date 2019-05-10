@extends('layouts.mainLayout.player_layout')

@section('content')
<div class="container" style="max-width:90%;">

    <div class="row">

            <form class="form-inline" action="{{ route('player_trainingPlayers.main',$teamID)}}" method="get">
                <div class="form-group">
                    {{ csrf_field()}}
                    <input type="text" class="form-control" name="search" placeholder="Meno hráča">
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit">{{ __('message.search') }}</button>
                </div>
            </form>


        <h1 class="NadpisTabulky" align="center">{{ __('message.squadtrainingplayers') }}</h1>

        <div class="panel-heading">
            <div class="">

                <table id="rooms-table" class="table table-bordered table-striped table-condensed" border=1 width="400">
                    <thead>
                    <tr>
                        <td colspan="2"  ><span style="color:red"style="font-weight:bold">{{ __('message.squadtrainingfocu') }}:</span></td>
                        <td colspan="2" style="text-align: center" >{{$content_of_training}}</td>

                    </tr>
                    <tr>
                        <th>{{ __('message.Player') }}</th>
                        <th>{{ __('message.age') }}</th>
                        <th>{{ __('message.position') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($players as $player)
                        <tr>
                            <td>{{$player->name}}</td>
                            <td>{{\Carbon\Carbon::parse($player->date_of_birth)->diff(\Carbon\Carbon::now())->format('%y ')}}</td>
                            <td>{{$player->position}}</td>
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