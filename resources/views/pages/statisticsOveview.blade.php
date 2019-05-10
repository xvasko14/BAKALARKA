@extends('layouts.mainLayout.main_layout')

@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li class="active">Štatistika hráčov</li>
        </ol>
    </div>

    <div class="container" style="max-width:90%;">
        <div class="row">


            <h1 class="NadpisTabulky" align="center">{{ __('message.Statistics') }}</h1>

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
                                <td> <a  href="{{ url('/statisticsOverview/statistics_goal') }}">{{ __('message.goals') }}</a> </td>
                            </tr>
                            <tr>
                                <td> <a  href="{{ url('/statisticsOverview/statistics_asists') }}">{{ __('message.asists') }}</a> </td>
                            </tr>
                            <tr>
                                <td> <a  href="{{ url('/statisticsOverview/statistics_yellowC') }}">{{ __('message.yellowC') }}</a> </td>
                            </tr>
                            <tr>
                                <td> <a  href="{{ url('/statisticsOverview/statistics_redC') }}">{{ __('message.redC') }}</a> </td>
                            </tr>
                            <tr>
                                <td> <a  href="{{ url('/statisticsOverview/statistics_min') }}">{{ __('message.mins') }}</a> </td>
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