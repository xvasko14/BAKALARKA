@extends('layouts.mainLayout.main_layout')

@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="/">{{ __('message.Home') }}</a></li>
            <li class="active">{{ __('message.LeagueTable') }}</li>
        </ol>
    </div>

    <div class="container" style="max-width:90%;">
        <div class="row">



                    <h1 align="center">{{ __('message.LeagueTable') }}</h1>

                    <div class="panel-heading">
                        <div class="table_league">
                            <div class="panel-body">

                                <table id="league-table" class="table table-bordered table-striped table-condensed" border=1 width="400">
                                    <thead>
                                    <tr>
                                        <th>{{ __('message.LeagueTable') }}</th>

                                    </thead>
                                    <tbody>
                                    @foreach($league as $key => $data)
                                        <tr>
                                            <td> <a  href="{{route('league.main',$data->id)}}">{{ $data->name}}</a> </td>
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