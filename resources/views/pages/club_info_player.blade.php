<!DOCTYPE html>
<html lang="en" >

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('message.playerProfile') }}a</title>


    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>

    <link rel="stylesheet" href="{{ asset('css/login_css/style.css') }}" />


</head>
<body>

<div class="bg">
    <div class="cardA">
        @foreach($players as $key => $data)
            <div class="BC">
                <img src="{{URL::asset('/images/main_images/hrac.jpeg')}}" alt="John" style="width:100%">
                <h1>{{ __('message.playername') }} : {{$data->name}}</h1>
                <p class="titleA">Vek : {{\Carbon\Carbon::parse($data->date_of_birth)->diff(\Carbon\Carbon::now())->format('%y ')}}</p>
                <p>{{ __('message.position') }}: {{$data->position}}</p>
                <p>{{ __('message.playernumber') }}: {{$data->player_number}}</p>
                <p>{{ __('message.playerweight') }}: {{$data->weight}}</p>
                <p>{{ __('message.playerheight') }}: {{$data->height}}</p>
                <p>{{ __('message.playercontact') }}: {{$data->email}}</p>
            </div>

        @endforeach
    </div>
</div>



</body>