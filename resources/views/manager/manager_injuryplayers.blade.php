@extends('layouts.mainLayout.manager_layout')

@section('content')

    <div class="container" style="max-width:90%;">
        <div class="row">


            <h1 align="center">Zraneni v time</h1>

            <div class="panel-heading">
                <div class="">

                    <table id="rooms-table" class="table table-bordered table-striped table-condensed" border=1 width="400">
                        <thead>
                        <tr>
                            <th>Hraci</th>
                            <th>Typ</th>
                            <th>Dlzka</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($players as $player)
                            <tr>
                                <th>{{$player->name}}</th>
                                <th>{{$player->type_injury}}</th>
                                <th>{{$player->approximately_time}}</th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>


@endsection