@extends('layouts.mainLayout.main_layout')

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
                                    <th>{{$teamL->name}}</th>
                                    <th>{{$teamL->position}}</th>
                                    <th>{{$teamL->goals}}</th>
                                    <th>{{$teamL->min}}</th>
                                    @if($teamL->substitution == 1)
                                        <th>Ano</th>
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
                                    <th>{{$teamR->name}}</th>
                                    <th>{{$teamR->position}}</th>
                                    <th>{{$teamR->goals}}</th>
                                    <th>{{$teamR->min}}</th>
                                    @if($teamR->substitution == 1)
                                        <th>Ano</th>
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
                                    <th>{{$teamLe->name}}</th>
                                    <th>{{$teamLe->position}}</th>
                                    <th>{{$teamLe->goals}}</th>
                                    <th>{{$teamLe->min}}</th>
                                    @if($teamLe->substitution == 1)
                                        <th>Ano</th>
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
                                    <th>{{$teamRe->name}}</th>
                                    <th>{{$teamRe->position}}</th>
                                    <th>{{$teamRe->goals}}</th>
                                    <th>{{$teamRe->min}}</th>
                                    @if($teamRe->substitution == 1)
                                        <th>Ano</th>
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