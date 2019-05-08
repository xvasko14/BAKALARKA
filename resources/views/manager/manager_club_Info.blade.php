@extends('layouts.mainLayout.manager_layout')

@section('content')

    <div class="container" style="max-width:90%;">
        <div class="row">


                    <h1 class="NadpisTabulky" align="center">Supiska Timu</h1>

                    <div class="panel-heading">
                        <div class="">

                            <table id="rooms-table" class="table table-bordered table-striped table-condensed" border=1 width="400">
                                <thead>
                                <tr>
                                    <th>Hraci</th>
                                    <th>Vek</th>
                                    <th>Pozicia</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($players as $key => $data)
                                    <tr>
                                        <th> <a  href="{{route('manager_club_InfoPlayer.main', $data->id)}}">{{ $data->name}}</a></th>
                                        <th>{{\Carbon\Carbon::parse($data->date_of_birth)->diff(\Carbon\Carbon::now())->format('%y ')}}</th>
                                        <th>{{$data->position}}</th>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>

        </div>
    </div>


@endsection