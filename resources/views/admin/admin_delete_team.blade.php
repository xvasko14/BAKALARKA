@extends('layouts.adminLayout.admin_design')
@section('obsah')



    <div id="content">

        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ url('/admin') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
        </div>

        <div class="container" style="max-width:80%; margin-top: 40px;">
            <form action="{{ route('admin.team.deleteTeam',$teams->id) }}" method="post">
                <div class="form-group">
                    {{ csrf_field()}}
                    <label for="name">Tím</label>
                    <input type="text" class="form-control" name="name" placeholder="Názov tímu" value="{{$teams->name}}">
                </div>
                <div class="form-group">
                    <label for="league">Liga</label>
                    <!--<input type="text" class="form-control" name="club" aria-describedby="club placeholder="Enter Klub:string">-->
                    <select name="league">
                        @foreach ($league as $league)
                            <option value="{{$league->id }}">{{$league->name }}</option>
                        @endforeach
                    </select>
                </div>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    <br>
                @endif
                <button type="submit" class="btn btn-primary">Vymazať</button>
            </form>

        </div>
    </div>

@endsection
