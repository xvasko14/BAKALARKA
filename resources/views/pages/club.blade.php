@extends('layouts.mainLayout.main_layout')

@section('content')

    <div class="container" style="max-width:90%;">
        <div class="row">

            <h1 class="NadpisTabulky" align="center">Moj klub</h1>
            <div class=" club1">
                <img src="{{URL::asset('/images/main_images/haniska_club.jpg')}}" alt="club1">
                @foreach($teams as $key => $data)
                    <td><button class="Clubik btn btn-primary" onclick="location.href='{{route('club_Info.main', $data->id)}}'">{{ $data->name}}</button></td>
                @endforeach

            </div>


        </div>
    </div>


@endsection