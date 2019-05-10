@extends('layouts.mainLayout.player_layout')

@section('content')
    <div class="container" style="max-width:90%;">

        <div class="row">
                    <h1 class="NadpisTabulky" align="center">{{ __('message.squadtraining') }}</h1>

                    <div class="panel-heading">
                        <div class="">

                            <table  id="rooms-table" class="table table-bordered table-striped table-condensed" border=1 width="400">
                                <thead>
                                <tr>
                                    <th>{{ __('message.squadtraining') }}</th>
                                    <th>{{ __('message.squadtrainingstarts') }}</th>
                                    <th>{{ __('message.squadtrainingspecializations') }}</th>
                                    <th>{{ __('message.squadtraininglenghts') }}</th>
                                    <th>{{ __('message.playertrainingaccept') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($training as $key => $data)
                                    <tr>
                                        <td><a  href="{{route('player_trainingPlayers.main', $data->id)}}">{{ $data->id}}</a> </td>
                                        @if ($data->signed)
                                            <td id="kolonka_green" >{{$data->starts}}</td>
                                        @else
                                            <td id="kolonka_red" >{{$data->starts}}</td>
                                        @endif
                                        <td>{{$data->specialization}}</td>
                                        <td>{{$data->length}}</td>
                                        <td> <center>
                                                @if ($data->signed)
                                                    <button id="bordeaux" onclick="location.href='{{route('player_Remove_training.main', $data->id)}}'"> {{ __('message.reject') }}</button>
                                                @else
                                                    <button id="green" onclick="location.href='{{route('player_Join_training.main', $data->id)}}'"> {{ __('message.squadtrainingParticipiated') }}</button>
                                                @endif

                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>


                        </div>
                    </div>
        </div>
    </div>


@endsection