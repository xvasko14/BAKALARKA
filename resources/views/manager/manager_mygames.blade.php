@extends('layouts.mainLayout.manager_layout')

@section('content')
    <div class="container" style="max-width:90%;">
        <div class="row">
            <h1 class="NadpisTabulky" align="center">{{ __('message.Matches') }}</h1>

                    <div class="panel-heading">
                        <div class="">

                            <table id="rooms-table" class="table table-bordered table-striped table-condensed" border=1 width="400">
                                <thead>
                                <tr>
                                    <th>{{ __('message.squadeditation') }}</th>
                                    <th>{{ __('message.matchid') }} </th>
                                    <th>{{ __('message.matchround') }}</th>
                                    <th>{{ __('message.matchdate') }} </th>
                                    <th>Team 1 </th>
                                    <th>{{ __('message.matchteam1') }} </th>
                                    <th>{{ __('message.matchteam2') }} </th>
                                    <th>Team 2 </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($game as $key => $data)
                                    <tr>
                                        <td> <a  href="{{route('manager.TeamsGame', $data->id)}}">{{ $data->id}}</a> </td>
                                        <td> <a  href="{{route('manager.TeamsGame.formation', $data->id)}}">{{ $data->id}}</a> </td>
                                        <td>{{$data->Round}}</td>
                                        <td>{{$data->Date}}</td>
                                        <td>{{$data->teamName1}}</td>
                                        <td>{{$data->team1_goals}}</td>
                                        <td>{{$data->team2_goals}}</td>
                                        <td>{{$data->teamName2}}</td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>

        </div>
    </div>


@endsection

