@extends('layouts.player_layout')

@section('content')

    <div class="container" style="max-width:90%;">

        <div class="row">

            <div class="col-md-11 col-md-offset-2">
                <div class="panel panel-default">
                    <h1 align="center">Trening timu</h1>

                    <div class="panel-heading">
                        <div class="">

                            <table id="rooms-table" class="table table-bordered table-striped table-condensed" border=1 width="400">
                                <thead>
                                <tr>
                                    <th>Trening</th>
                                    <th>Zaciatok</th>
                                    <th>Dlzka</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($training as $key => $data)
                                    <tr>
                                        <th>{{$data->id}}</th>
                                        <th>{{$data->starts}}</th>
                                        <th>{{$data->length}}</th>
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