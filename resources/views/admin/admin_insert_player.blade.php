@extends('layouts.adminLayout.admin_design')
@section('obsah')

   

<div id="content">

        <div id="content-header">
             <div id="breadcrumb"> <a href="{{ url('/admin') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
        </div>

    <div class="container" style="max-width:80%; margin-top: 40px;">
        <form action="{{ route('admin.player.insertPlayer') }}" method="post">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                <br>
            @endif
            <div class="form-group">
                {{ csrf_field()}}
                <label for="meno">Meno</label>
                <input type="text" class="form-control" name="name" placeholder="Meno uživateľa">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
                <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Email">
            </div>
            <div class="form-group">
              <label for="email">Vek</label>
                <input type="date" class="form-control" name="age" aria-describedby="age" placeholder="Enter Vek">
            </div>
                <div class="form-group">
                    <label for="weight">Váha</label>
                    <input type="number" class="form-control" name="weight" aria-describedby="weight" placeholder="Váha">
                </div>
                <div class="form-group">
                    <label for="height">Výška</label>
                    <input type="number" class="form-control" name="height" aria-describedby="height" placeholder="Výška">
                </div>
                <div class="form-group">
                    <label for="player_number">Cislo dresu</label>
                    <input type="number" class="form-control" name="player_number" aria-describedby="height" placeholder="Čislo dresu">
                </div>
            <div class="form-group">
              <label for="email">Pozicia</label>
                <input type="text" class="form-control" name="position" aria-describedby="position" placeholder="Pozícia hráča">
            </div>
            <div class="form-group">
              <label for="email">Klub</label>
                <!--<input type="text" class="form-control" name="club" aria-describedby="club placeholder="Enter Klub:string">-->
                <select name="club">
                    @foreach ($teams as $team)
                        <option value="{{$team->id }}">{{$team->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="password">Heslo</label>
                <input type="password" class="form-control" name="password"  pattern=".{7,}" title="7 a viac znakov" placeholder="Heslo">
            </div>

            <div class="form-group">
                <label for="password">Potvrdenie hesla</label>
                <input type="password" class="form-control" name="password2" placeholder="Heslo">
            </div>

            <button type="submit" class="btn btn-primary">Odoslať</button>
        </form>

    </div>
</div>

@endsection
