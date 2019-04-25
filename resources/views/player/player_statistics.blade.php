@extends('layouts.mainLayout.player_layout')

@section('content')
    <div class="container" style="max-width:90%;">
        <div class="row">

                    <h1 align="center">Statistiky hracov v lige</h1>

                    <div class="panel-heading">
                        <div class="">

                            <table id="rooms-table" class="table table-bordered table-striped table-condensed" border=1 width="400">
                                <thead>
                                <tr>
                                    <th>Hraci</th>
                                    <th>Vek</th>
                                    <th>Pozicia</th>
                                    <th>Goly</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($statistics as $statistic)
                                    <tr>
                                        <th>{{$statistic->name}}</th>
                                        <th>{{$statistic->age}}</th>
                                        <th>{{$statistic->position}}</th>
                                        <th>{{$statistic->goals}}</th>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>

    </div>


@endsection