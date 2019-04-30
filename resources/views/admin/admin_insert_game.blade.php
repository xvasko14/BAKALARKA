@extends('layouts.adminLayout.admin_design')
@section('obsah')



    <div id="content">

        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ url('/admin') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
        </div>

        <div class="container" style="max-width:80%; margin-top: 40px;">
            <form action="{{ route('admin.game.insertGame') }}" method="post">
                <div class="form-group">
                    {{ csrf_field()}}
                    <label for="sezona">Sezona</label>
                    <!--<input type="text" class="form-control" name="club" aria-describedby="club placeholder="Enter Klub:string">-->
                    <select name="sezona">
                        @foreach ($sezona as $sezon)
                            <option value="{{$sezon->id }}">{{$sezon->season }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    {{ csrf_field()}}
                    <label for="Round">Kolo Ligy</label>
                    <input type="text" class="form-control" name="Round" placeholder="Ligove kolo">
                </div>
                <div class="form-group">
                    {{ csrf_field()}}
                    <label for="starts">Datum</label>
                    <input type="Date" class="form-control" name="Date" placeholder="Datum">
                </div>
                <div class="form-group">
                    {{ csrf_field()}}
                    <label for="starts">Zaciatok zapasu</label>
                    <input type="time" class="form-control" name="time" placeholder="Cas">
                </div>
                <div class="form-group">
                    {{ csrf_field()}}
                    <label for="email">Klub</label>
                    <!--<input type="text" class="form-control" name="club" aria-describedby="club placeholder="Enter Klub:string">-->
                    <select name="club1">
                        @foreach ($teams as $team)
                            <option value="{{$team->id }}">{{$team->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="email">Klub</label>
                    <!--<input type="text" class="form-control" name="club" aria-describedby="club placeholder="Enter Klub:string">-->
                    <select name="club2">
                        @foreach ($teams as $team)
                            <option value="{{$team->id }}">{{$team->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    {{ csrf_field()}}
                    <label for="result1">Tim</label>
                    <input type="text" class="form-control" name="result1" placeholder="Result1">
                </div>
                <div class="form-group">
                    {{ csrf_field()}}
                    <label for="result2">Tim</label>
                    <input type="text" class="form-control" name="result2" placeholder="Result2">
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
