@extends('layouts.adminLayout.admin_design')
@section('obsah')


    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ url('/admin') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
        </div>
        <div class="container" style="max-width:90%;">
            <div class="row">
                @if (session('insert'))
                    <div class="alert alert-success">
                        {{ session('insert') }}
                    </div>
                    <br>
                @endif
                @if (session('deleted'))
                    <div class="alert alert-success">
                        {{ session('deleted') }}
                    </div>
                    <br>
                @endif
                @if (session('updated'))
                    <div class="alert alert-success">
                        {{ session('updated') }}
                    </div>
                    <br>
                @endif

                <div class="col-md-11 col-md-offset-2">
                    <div class="panel panel-default">
                        <h1 align="center">Zoznam tréningov</h1>

                        <div class="panel-heading">
                            <div class="">
                                <div class="panel-body">

                                    <table id="rooms-table" class="table table-bordered table-striped table-condensed" border=1 width="400">
                                        <thead>
                                        <tr>
                                            <th>Tim ID</th>
                                            <th>Čas</th>
                                            <th>Dlžka</th>
                                            <th>Editácie</th>
                                            <th>Vymazanie</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($training as $key => $data)
                                            <tr>
                                                <th>{{ $data->teamTraining_id}}</th>
                                                <th>{{ $data->starts}}</th>
                                                <th>{{ $data->length}}</th>
                                                <th> <center><a class='btn-floating  waves-effect blue darken-4' href="{{route('admin.training.update',$data->id)}}"><i class='material-icons'>edit</i></a></center> </th>
                                                <th> <center><a class='btn-floating  waves-effect blue darken-4' href="{{route('admin.training.delete',$data->id)}}"><i class='material-icons'>delete</i></a></center> </th>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <span>{{ $training->links() }}</span>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection