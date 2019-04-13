@extends('layouts.mainLayout.player_layout')

@section('content')

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
                                            <th> <a  href="{{route('player_league.main', $data->id)}}">{{ $data->name}}</a> </th>
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