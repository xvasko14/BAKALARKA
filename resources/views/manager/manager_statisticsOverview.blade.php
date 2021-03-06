@extends('layouts.mainLayout.manager_layout')

@section('content')

    <div class="container" style="max-width:90%;">
        <div class="row">


            <h1 class="NadpisTabulky" align="center">{{ __('message.Statistics') }}</h1>

            <div class="panel-heading">
                <div class="">
                    <div class="panel-body">

                        <table id="rooms-table" class="table table-bordered table-striped table-condensed" border=1 width="400">
                            <thead>
                            <tr>
                                <th>{{ __('message.PlayerStatistics') }}</th>

                            </thead>
                            <tbody>

                            <tr>
                                <td> <a  href="{{ url('/manager_home/manager_statisticsOverview/statistics') }}">{{ __('message.goals') }}</a> </td>
                            </tr>
                            <tr>
                                <td> <a  href="{{ url('/manager_home/manager_statisticsOverview/statistics_asists') }}">{{ __('message.asists') }}</a> </td>
                            </tr>
                            <tr>
                                <td> <a  href="{{ url('/manager_home/manager_statisticsOverview/statistics_yellowC') }}">{{ __('message.yellowC') }}</a> </td>
                            </tr>
                            <tr>
                                <td> <a  href="{{ url('/manager_home/manager_statisticsOverview/statistics_redC') }}">{{ __('message.redC') }}</a> </td>
                            </tr>
                            <tr>
                                <td> <a  href="{{ url('/manager_home/manager_statisticsOverview/statistics_min') }}">{{ __('message.mins') }}</a> </td>
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




{{--
    <div class="container" style="max-width:90%;">
        <div class="row">


                    <h1 align="center">Prehlad Lig</h1>

                        <div class="panel-heading">
                            <div class="">
                                <div class="panel-body">

                                    <table id="rooms-table" class="table table-bordered table-striped table-condensed" border=1 width="400">
                                        <thead>
                                        <tr>
                                            <th>Liga</th>

                                        </thead>
                                        <tbody>
                                        @foreach($league as $key => $data)
                                            <tr>
                                                <th> <a  href="{{route('manager_statistics.main', $data->id)}}">{{ $data->name}}</a> </th>
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
--}}