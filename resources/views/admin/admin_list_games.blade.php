@extends('layouts.adminLayout.admin_design')
@section('obsah')


    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ url('/admin') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
        </div>
        <div class="container" style="max-width:90%;">
            <div class="row">

                <div class="col-md-11 col-md-offset-2">
                    <div class="panel panel-default">
                        <h1 align="center">Zoznam tímov</h1>

                        <div class="panel-heading">
                            <div class="">
                                <div class="panel-body">

                                    <table id="rooms-table" class="table table-bordered table-striped table-condensed" border=1 width="400">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Team1</th>
                                            <th>Team1 Góly</th>
                                            <th>Team2 Góly</th>
                                            <th>Team2</th>
                                            <th>Editacia</th>
                                            <th>Vymazanie</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($game as $key => $data)
                                            <tr>
                                                <th>{{$data->id}}</th>
                                                <th>{{$data->teamName1}}</th>
                                                <th>{{$data->team1_goals}}</th>
                                                <th>{{$data->team2_goals}}</th>
                                                <th>{{$data->teamName2}}</th>
                                                <th> <center><a class='btn-floating  waves-effect blue darken-4' href="{{route('admin.game.update',$data->id)}}"><i class='material-icons'>edit</i></a></center> </th>
                                                <th> <center><a class='btn-floating  waves-effect blue darken-4' href="{{route('admin.game.delete',$data->id)}}"><i class='material-icons'>delete</i></a></center> </th>

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
        </div>
    </div>

@endsection