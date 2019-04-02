@extends('layouts.adminLayout.admin_design')
@section('obsah')



    <div id="content">

        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ url('/admin') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
        </div>

        <div class="container" style="max-width:80%; margin-top: 40px;">
            <form action="{{ route('admin.training.insertTraining') }}" method="post">
                <div class="form-group">
                    {{ csrf_field()}}
                    <label for="starts">Zaciatok treningu</label>
                    <input type="time" class="form-control" name="time" placeholder="Zaciatok treningu">
                </div>
                <div class="form-group">
                    {{ csrf_field()}}
                    <label for="starts">Datum</label>
                    <input type="date" class="form-control" name="date" placeholder="Datum">
                </div>
                <div class="form-group">
                    <label for="length">Dlzka</label>
                    <input type="text" class="form-control" name="length"  placeholder="Cas">
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
