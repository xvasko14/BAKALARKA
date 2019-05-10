@extends('layouts.mainLayout.manager_layout')

@section('content')

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ url('/admin') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
        </div>

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
                                        <th>ID Zapasu </th>
                                        <th>Team 1 </th>
                                        <th>Team 1 Skore </th>
                                        <th>Team 2 SKore </th>
                                        <th>Team 2 </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($game as $key => $data)
                                        <tr>
                                            <td> <a  href="{{route('manager.TeamsGame', $data->id)}}">{{ $data->id}}</a> </td>
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
            </div>
        </div>


@endsection
