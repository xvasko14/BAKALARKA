@extends('layouts.manager_layout')

@section('content')

    <div class="container" style="max-width:90%;">
        <div class="row">

            <div class="col-md-11 col-md-offset-2">
                <div class="panel panel-default">
                    <h1 align="center">Supiska timov</h1>

                    <div class="panel-heading">
                        <div class="">

                            <table id="rooms-table" class="table table-bordered table-striped table-condensed" border=1 width="400">
                                <thead>
                                <tr>
                                    <th>Hrac</th>
                                    <th>Pozicia</th>
                                    <th>Goly</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($players as $key => $data)
                                    <tr>
                                        <th>{{$data->name}}</th>
                                        <th>{{$data->position}}</th>
                                        <th>{{$data->goals}}</th>
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