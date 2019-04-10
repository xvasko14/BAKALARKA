@extends('layouts.manager_layout')

@section('content')


        <div class="row">
            <div class="col-xs-6">
                <div class="Left">
                <div class="panel panel-default">
                    <h1 align="center">Supiska timov</h1>

                    <div class="panel-heading">

                            <table id="rooms-table" class="table table-bordered table-striped table-condensed" border=1 width="400">
                                <thead>
                                <tr>
                                    <th>Hrac</th>
                                    <th>Pozicia</th>
                                    <th>Goly</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($teamLeft as $teamL)
                                    <tr>
                                        <th>{{$teamL->name}}</th>
                                        <th>{{$teamL->position}}</th>
                                        <th>{{$teamL->goals}}</th>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="Right">
                <div class="panel panel-default">
                    <h1 align="center">Supiska timov</h1>

                    <div class="panel-heading">

                        <table id="rooms-table" class="table table-bordered table-striped table-condensed" border=1 width="400">
                            <thead>
                            <tr>
                                <th>Hrac</th>
                                <th>Pozicia</th>
                                <th>Goly</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($teamRight as $teamR)
                                <tr>
                                    <th>{{$teamR->name}}</th>
                                    <th>{{$teamR->position}}</th>
                                    <th>{{$teamR->goals}}</th>
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