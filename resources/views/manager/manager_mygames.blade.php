@extends('layouts.manager_layout')

@section('content')

    <div class="container" style="max-width:90%;">
        <div class="row">

            <div class="col-md-11 col-md-offset-2">
                <div class="panel panel-default">
                    <h1 align="center">Zapasy</h1>

                    <div class="panel-heading">
                        <div class="">

                            <table id="rooms-table" class="table table-bordered table-striped table-condensed" border=1 width="400">
                                <thead>
                                <tr>
                                    <th>Zapas ID </th>
                                    <th>Team 1 </th>
                                    <th>Team 1 Skore </th>
                                    <th>Team 2 SKore </th>
                                    <th>Team 2 </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($game as $key => $data)
                                    <tr>
                                        <th> <a  href="{{route('manager.TeamsGame', $data->id)}}">{{ $data->id}}</a> </th>
                                        <th>{{$data->teamName1}}</th>
                                        <th>{{$data->team1_goals}}</th>
                                        <th>{{$data->team2_goals}}</th>
                                        <th>{{$data->teamName2}}</th>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

