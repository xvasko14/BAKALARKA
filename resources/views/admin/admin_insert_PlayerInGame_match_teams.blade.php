@extends('layouts.adminLayout.admin_design')

@section('obsah')

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{ url('/admin') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
    </div>

    <div class="container" style="max-width:90%;">
        <div class="row">

            <div class="col-md-11 col-md-offset-2">
                <div class="panel panel-default">
                    <h1 align="center">Zápasy</h1>

                    <div class="panel-heading">
                        <div class="">

                            <table id="rooms-table" class="table table-bordered table-striped table-condensed" border=1 width="400">
                                <thead>
                                <tr>
                                    <th>Team 1 </th>
                                    <th>Team 2 </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($game as $key => $data)
                                <tr>
                                    <th> <a  href="{{route('admin.newPlayerInGame', [$data->team1, $data->id])}}">{{$data->teamName1}}</a> </th>
                                    <th> <a  href="{{route('admin.newPlayerInGame', [$data->team2, $data->id])}}">{{$data->teamName2}}</a> </th>
                                </tr>
                                @endforeach
                                </tbody>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
