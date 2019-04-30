<!DOCTYPE html>
<html lang="en" >

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Day 001 Login Form</title>


    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>

    <link rel="stylesheet" href="{{ asset('css/login_css/style.css') }}" />


</head>
<body>

<div class="bg">
<div class="cardA">
    @foreach($players as $key => $data)
    <div class="BC">
        <img src="{{URL::asset('/images/main_images/hrac.jpeg')}}" alt="John" style="width:100%">
        <h1>Meno : {{$data->name}}</h1>
        <p class="titleA">Vek : {{$data->age}}</p>
        <p>Pozicia: {{$data->position}}</p>
        <p>Kontakt: {{$data->email}}</p>
   </div>

    @endforeach
</div>
</div>



</body>