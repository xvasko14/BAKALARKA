@extends('layouts.manager_layout')

@section('content')

    <div class="container" style="max-width:90%;">
        <div class="row">

            <div class="col-md-11 col-md-offset-2">
                <div class="panel panel-default">
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
                                            <th> <a  href="{{route('manager_league.main', $data->id)}}">{{ $data->name}}</a> </th>
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
    </div>
    </div>

@endsection