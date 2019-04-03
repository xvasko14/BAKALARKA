@extends('layouts.adminLayout.admin_design')
@section('obsah')

   

<div id="content">

        <div id="content-header">
             <div id="breadcrumb"> <a href="{{ url('/admin') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
        </div>

    <div class="container" style="max-width:80%; margin-top: 40px;">
        <form action="{{ route('admin.manager.insertManager') }}" method="post">
            <div class="form-group">
                {{ csrf_field()}}
                <label for="meno">Meno</label>
                <input type="text" class="form-control" name="name" placeholder="Meno uživateľa">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
                <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
              <label for="email">Vek</label>
                <input type="text" class="form-control" name="age" aria-describedby="age" placeholder="Enter Vek">
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
                <input type="password" class="form-control" name="password" placeholder="Heslo">
            </div>

            <div class="form-group">
                <label for="password">Potvrdenie hesla</label>
                <input type="password" class="form-control" name="password2" placeholder="Heslo">
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