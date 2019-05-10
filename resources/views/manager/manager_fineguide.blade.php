@extends('layouts.mainLayout.manager_layout')

@section('content')
    <div class="container" style="max-width:90%;">
        <div class="row">

            <h1 class="NadpisTabulky" align="center">Pokuty v tíme</h1>
            <div class="flex">
                <div class="flex-item">
                    <td><button class="ZranenieTvorba btn btn-primary"  onclick="location.href='{{route('manager_fine.main')}}'">Zadat pokutu</button></td>
                </div>
                <div class="flex-item">
                    <td><button class="ZranenieVsetci btn btn-primary" onclick="location.href='{{route('manager_fineplayers.main')}}'">Pokutovani hraci</button></td>
                </div>
            </div>
            <div class=" pokuta1">
                <img src="{{URL::asset('/images/main_images/pokuta.jpg')}}" alt="pokuta" >

            </div>
        </div>

    </div>
    </div>


@endsection