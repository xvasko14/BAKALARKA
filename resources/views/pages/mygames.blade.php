@extends('layouts.mainLayout.main_layout')

@section('content')
    <div class="container" style="max-width:90%;">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li class="active">Zapasy</li>
        </ol>
        <div class="row">
            <h1 class="NadpisTabulky" align="center">Zapasy</h1>

            <div class="panel-heading">
                <div class="">

                    <table id="rooms-table" class="table table-bordered table-striped table-condensed" border=1 width="400">
                        <thead>
                        <tr>
                            <th>Zapas ID </th>
                            <th>Kolo </th>
                            <th>Datum </th>
                            <th>Team 1 </th>
                            <th>Team 1 Skore </th>
                            <th>Team 2 SKore </th>
                            <th>Team 2 </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($game as $key => $data)
                            <tr>
                                <td> <a  href="{{route('TeamsGame', $data->id)}}">{{ $data->id}}</a> </td>
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