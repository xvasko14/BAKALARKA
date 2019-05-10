@extends('layouts.mainLayout.player_layout')

@section('content')

    <div class="container" style="max-width:90%;">
        <div class="row">




            <h1 class="NadpisTabulky" align="center">{{ __('message.teamsupiska') }}</h1>

            <div class="panel-heading">
                <div class="">

                    <table id="rooms-table" class="table table-bordered table-striped table-condensed" border=1 width="400">
                        <thead>
                        <tr>
                            <th>{{ __('message.players') }}</th>
                            <th>{{ __('message.age') }}</th>
                            <th>{{ __('message.position') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($players as $key => $data)
                            <tr>
                                <td> <a  href="{{route('player_club_InfoPlayer.main', $data->id)}}">{{ $data->name}}</a></td>
                                <td>{{\Carbon\Carbon::parse($data->date_of_birth)->diff(\Carbon\Carbon::now())->format('%y ')}}</td>
                                <td>{{$data->position}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>


                </div>
            </div>

        </div>
    </div>



@endsection