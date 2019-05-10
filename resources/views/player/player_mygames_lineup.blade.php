@extends('layouts.mainLayout.player_layout')

@section('content')


    <div class="row">
        <div class="col-xs-6">
            <div class="LeftTable">
                <div class="panel panel-default">
                    <h1 align="center">Zakladna zostava Tim 1.</h1>

                    <div class="panel-heading">

                        <table id="rooms-table" class="table table-bordered table-striped table-condensed" border=1 width="400">
                            <thead>
                            <tr>
                                <th>Hrac</th>
                                <th>Pozicia</th>
                                <th>Goly</th>
                                <th>Minúty</th>
                                <th>Striedal</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($teamLeft as $teamL)
                                <tr>
                                    <td>{{$teamL->name}}</td>
                                    <td>{{$teamL->position}}</td>
                                    <td>{{$teamL->goals}}</td>
                                    <td>{{$teamL->min}}</td>
                                    @if($teamL->substitution == 1)
                                        <td>Ano</td>
                                    @endif


                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xs-6">
            <div class="RightTable">
                <div class="panel panel-default">
                    <h1 align="center">Zakladna zostava Tim 2.</h1>

                    <div class="panel-heading">

                        <table id="rooms-table" class="table table-bordered table-striped table-condensed" border=1 width="400">
                            <thead>
                            <tr>
                                <th>Hrac</th>
                                <th>Pozicia</th>
                                <th>Goly</th>
                                <th>Minúty</th>
                                <th>Striedal</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($teamRight as $teamR)
                                <tr>
                                    <td>{{$teamR->name}}</td>
                                    <td>{{$teamR->position}}</td>
                                    <td>{{$teamR->goals}}</td>
                                    <td>{{$teamR->min}}</td>
                                    @if($teamR->substitution == 1)
                                        <td>Ano</td>
                                    @endif
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div style="clear:both;"></div>
        <div class="col-xs-6">
            <div class="LeftTable">
                <div class="panel panel-default">
                    <h1 align="center">Nahradnici 1.</h1>

                    <div class="panel-heading">

                        <table id="rooms-table" class="table table-bordered table-striped table-condensed" border=1 width="400">
                            <thead>
                            <tr>
                                <th>Hrac</th>
                                <th>Pozicia</th>
                                <th>Goly</th>
                                <th>Minúty</th>
                                <th>Striedal</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($teamLeftSub as $teamLe)
                                <tr>
                                    <td>{{$teamLe->name}}</td>
                                    <td>{{$teamLe->position}}</td>
                                    <td>{{$teamLe->goals}}</td>
                                    <td>{{$teamLe->min}}</td>
                                    @if($teamLe->substitution == 1)
                                        <td>Ano</td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-6">
            <div class="RightTable">
                <div class="panel panel-default">
                    <h1 align="center">Nahradnici 2.</h1>

                    <div class="panel-heading">

                        <table id="rooms-table" class="table table-bordered table-striped table-condensed" border=1 width="400">
                            <thead>
                            <tr>
                                <th>Hrac</th>
                                <th>Pozicia</th>
                                <th>Goly</th>
                                <th>Minúty</th>
                                <th>Striedal</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($teamRightSub as $teamRe)
                                <tr>
                                    <td>{{$teamRe->name}}</td>
                                    <td>{{$teamRe->position}}</td>
                                    <td>{{$teamRe->goals}}</td>
                                    <td>{{$teamRe->min}}</td>
                                    @if($teamRe->substitution == 1)
                                        <td>Ano</td>
                                    @endif
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