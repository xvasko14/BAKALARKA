@extends('layouts.mainLayout.manager_layout')

@section('content')
    <div class="container" style="max-width:90%;">
        <div class="row">

            <h1 class="NadpisTabulky" align="center">Zraneni v time</h1>
            <div class="flex">
                <div class="flex-item">
                <td><button class="ZranenieTvorba btn btn-primary"  onclick="location.href='{{route('manager_injury.main')}}'">Vytvorit Zranenie</button></td>
                </div>
                <div class="flex-item">
                <td><button class="ZranenieVsetci btn btn-primary" onclick="location.href='{{route('manager_injuryplayers.main')}}'">Zraneni hraci</button></td>
                </div>
            </div>
            <div class=" zranenie1">
                <img src="{{URL::asset('/images/main_images/zranenie_photo.jpg')}}" alt="zranenie" >

            </div>
            </div>

        </div>
    </div>


@endsection