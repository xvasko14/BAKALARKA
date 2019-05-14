@extends('layouts.mainLayout.manager_layout')

@section('content')

    <div class="container" style="max-width:90%;">

        <div class="row">

                    <h1 class="NadpisTabulky" align="center">{{ __('message.squadtraining') }}</h1>

                    <div class="panel-heading">
                        <div class="">

                            <table id="rooms-table" class="table table-bordered table-striped table-condensed" border=1 width="400">
                                <thead>
                                <tr>
                                    <th>{{ __('message.squadtraining') }}</th>
                                    <th>{{ __('message.squadtrainingstarts') }}</th>
                                    <th>{{ __('message.squadtrainingspecializations') }}</th>
                                    <th>{{ __('message.squadtraininglenghts') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($training as $key => $data)
                                    <tr>
                                        <td> <a style="color: #1d643b"  href="{{route('manager_trainingPlayers.main', $data->id)}}">{{ $data->id}}</a> </td>
                                        <td>{{$data->starts}}</td>
                                        <td>{{$data->specialization}}</td>
                                        <td>{{$data->length}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>


                        </div>
                    </div>

        </div>


    </div>


@endsection