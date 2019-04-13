@extends('layouts.mainLayout.manager_layout')

@section('content')

    <div class="container" style="max-width:90%;">
        <div class="row">

            <h1 align="center">Moj klub</h1>
            <div class=" club1">
                <img src="{{URL::asset('/images/main_images/haniska_club.jpg')}}" alt="club1">
                @foreach($teams as $key => $data)
                    <td><button class="Clubik btn btn-primary" onclick="location.href='{{route('manager_club_Info.main', $data->id)}}'">{{ $data->name}}</button></td>
                @endforeach

            </div>


        </div>
    </div>


@endsection
