@extends('layouts.mainLayout.player_layout')

@section('content')

    <div class="container" style="max-width:90%;">
        <div class="row">
                    <h1 align="center">Moj Klub</h1>

                    <div class="panel-heading">
                        <div class="">

                            <table id="club-table"class="table table-bordered table-striped table-condensed" border=1 width="400">
                                <thead>
                                <tr>
                                    <th>Moj klub</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($teams as $key => $data)
                                    <tr>
                                        <th> <a  href="{{route('player_club_Info.main', $data->id)}}">{{ $data->name}}</a> </th>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                <
        </div>
    </div>


@endsection

