@extends('layouts.mainLayout.manager_layout')

@section('content')

    <div class="container" style="max-width:90%;">
        <div class="row">


            <div class="panel panel-default">
                <h1 align="center">Ligova tabulka</h1>

                <div class="panel-heading">
                    <div class="">

                        <table id="rooms-table" class="table  table-striped table-dark " border=1 width="400">
                            <thead>
                            <tr>
                                <th>Tim</th>
                                <th>Skore</th>
                                <th>Goly</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($teams as $key => $data)
                                <tr>
                                    <th>{{$data->name}}</th>
                                    <th>{{$data->score}}</th>
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


@endsection