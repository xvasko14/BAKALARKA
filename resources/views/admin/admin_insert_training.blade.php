@extends('layouts.adminLayout.admin_design')
@section('obsah')



    <div id="content">

        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ url('/admin') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
        </div>

        <div class="container" style="max-width:80%; margin-top: 40px;">
            <form action="{{ route('admin.training.insertTraining') }}" method="post">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    <br>
                @endif
                <div class="form-group">
                    {{ csrf_field()}}
                    <label for="starts">Začiatok treningu</label>
                    <input type="time" class="form-control" name="time" placeholder="Začiatok treningu">
                </div>
                <div class="form-group">
                    {{ csrf_field()}}
                    <label for="starts">Dátum</label>
                    <input type="date" class="form-control" name="date" placeholder="Datum">
                </div>
                    <div class="form-group">
                        {{ csrf_field()}}
                        <label for="specialization">Datum</label>
                        <input type="text" class="form-control" name="specialization" placeholder="Zameranie treningu">
                    </div>
                <div class="form-group">
                    <label for="length">Dlžka</label>
                    <input type="text" class="form-control" name="length"  placeholder="Čas">
                </div>
                <div class="form-group">
                    <label for="club">Klub</label>
                    <!--<input type="text" class="form-control" name="club" aria-describedby="club placeholder="Enter Klub:string">-->
                    <select name="club">
                        @foreach ($teams as $team)
                            <option value="{{$team->id }}">{{$team->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Odoslať</button>
            </form>

        </div>
    </div>


@endsection
