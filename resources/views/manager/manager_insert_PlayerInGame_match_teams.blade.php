@extends('layouts.mainLayout.manager_layout')

@section('content')

    <div class="container" style="max-width:90%;">
    <div class="row">


        <div class="panel panel-default">
            <h1 align="center">Ligova tabulka</h1>

            <div class="panel-heading">
                <div class="">
                                <table id="rooms-table" class="table table-bordered table-striped table-condensed" border=1 width="400">
                                    <thead>
                                    <tr>
                                        <th>Team 1 </th>
                                        <th>Team 2 </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($game as $key => $data)
                                        <tr>
                                            <td> <a  href="{{route('manager.newPlayerInGame', [$data->team1, $data->id])}}">{{$data->teamName1}}</a> </td>
                                            <td> <a  href="{{route('manager.newPlayerInGame', [$data->team2, $data->id])}}">{{$data->teamName2}}</a> </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
