@extends('layouts.mainLayout.manager_layout')

@section('content')
    <div class="container" style="max-width:90%;">
        <div class="row">

            <h1 class="NadpisTabulky" align="center">{{ __('message.squadtraining') }}</h1>
            <div class="flex">
                <div class="flex-item">
                    <td><button class="ZranenieTvorba btn btn-primary"  onclick="location.href='{{route('manager_training.main')}}'">{{ __('message.squadtraining') }}</button></td>
                </div>
                <div class="flex-item">
                    <td><button class="ZranenieVsetci btn btn-primary" onclick="location.href='{{route('manager.training.insert')}}'">{{ __('message.squadtrainingcreate') }}</button></td>
                </div>
            </div>
            <div class=" training1">
                <img src="{{URL::asset('/images/main_images/TR.jpg')}}" alt="training1" >

            </div>
        </div>

    </div>
    </div>


@endsection