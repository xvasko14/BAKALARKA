@extends('layouts.adminLayout.admin_design')
@section('obsah')

<div id="content">

        <div id="content-header">
             <div id="breadcrumb"> <a href="{{ url('/admin') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
        </div>

    <div class="container" style="max-width:80%; margin-top: 40px;">
        <form action="{{ route('admin.player.updatePlayer',$players->id) }}" method="post">
            <div class="form-group">
                {{ csrf_field()}}
                <label for="meno">Meno</label>
                <input type="text" class="form-control" name="name" placeholder="Meno uživateľa" value="{{$players->name}}">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
                <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Email" value="{{$players->email}}">
            </div>
            <div class="form-group">
              <label for="age">Vek</label>
                <input type="date" class="form-control" name="age" aria-describedby="age" placeholder="Vek" value="{{$players->date_of_birth}}">
            </div>
            <div class="form-group">
                <label for="weight">Váha</label>
                <input type="number" class="form-control" name="weight" aria-describedby="weight" placeholder="Váha" value="{{$players->weight}}">
            </div>
            <div class="form-group">
                <label for="height">Výška</label>
                <input type="number" class="form-control" name="height" aria-describedby="height" placeholder="Výška" value="{{$players->height}}">
            </div>
            <div class="form-group">
                <label for="player_number">Čislo dresu</label>
                <input type="number" class="form-control" name="player_number" aria-describedby="height" placeholder="Čislo dresu" value="{{$players->player_number}}">
            </div>
            <div class="form-group">
              <label for="position">Pozícia</label>
                <input type="text" class="form-control" name="position" aria-describedby="position" placeholder="Pozícia" value="{{$players->position}}">
            </div>
            <div class="form-group">
              <label for="club">Klub</label>
                <!--<input type="text" class="form-control" name="club" aria-describedby="club placeholder="Enter Klub:string">-->
                <select name="club">
                    @foreach ($teams as $teams)
                        <option value="{{$teams->id }}">{{$teams->name }}</option>
                    @endforeach
                </select>
            </div>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    <br>
                @endif
            <button type="submit" class="btn btn-primary">Odoslať</button>
        </form>

    </div>
 </div>

@endsection
