@extends('layouts.mainLayout.player_layout')

@section('content')

    <div class="container" style="max-width:90%;">
        <div class="row">


            <h1 class="NadpisTabulky" align="center">Prehľad štatistík</h1>

            <div class="panel-heading">
                <div class="">
                    <div class="panel-body">

                        <table id="rooms-table" class="table table-bordered table-striped table-condensed" border=1 width="400">
                            <thead>
                            <tr>
                                <th>Statistiky</th>

                            </thead>
                            <tbody>

                            <tr>
                                <td> <a  href="{{ url('/player_home/player_statisticsOverview/statistics_goal') }}">Goly</a> </td>
                            </tr>
                            <tr>
                                <td> <a  href="{{ url('/player_home/player_statisticsOverview/statistics_asists') }}">Asistencie</a> </td>
                            </tr>
                            <tr>
                                <td> <a  href="{{ url('/player_home/player_statisticsOverview/statistics_yellowC') }}">Zlte karty</a> </td>
                            </tr>
                            <tr>
                                <td> <a  href="{{ url('/player_home/player_statisticsOverview/statistics_redC') }}">Cervene karty</a> </td>
                            </tr>
                            <tr>
                                <td> <a  href="{{ url('/player_home/player_statisticsOverview/statistics_mins') }}">Minuty</a> </td>
                            </tr>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>

@endsection