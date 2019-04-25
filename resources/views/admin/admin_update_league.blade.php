@extends('layouts.adminLayout.admin_design')
@section('obsah')



    <div id="content">

        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ url('/admin') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
        </div>

        <div class="container" style="max-width:80%; margin-top: 40px;">
            <form action="{{ route('admin.league.updateLeague',$league->id) }}" method="post">
                <div class="form-group">
                    {{ csrf_field()}}
                    <label for="meno">Tim</label>
                    <input type="text" class="form-control" name="name" placeholder="Nazov ligy" value="{{$league->name}}">
                </div>
                <div class="form-group">
                    <label for="email">Pocet Timov</label>
                    <input type="text" class="form-control" name="teams_number" aria-describedby="teams_number" placeholder="Pocet timov" value="{{$league->teams_number}}">
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
