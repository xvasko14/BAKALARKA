@extends('layouts.adminLayout.admin_design')
@section('obsah')



    <div id="content">

        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ url('/admin') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
        </div>

        <div class="container" style="max-width:80%; margin-top: 40px;">
            <form action="{{ route('admin.injury.insertInjury') }}" method="post">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    <br>
                @endif
                <div class="form-group">
                    <label for="club">Hrac</label>
                    <!--<input type="text" class="form-control" name="club" aria-describedby="club placeholder="Enter Klub:string">-->
                    <select name="player">
                        @foreach ($players as $dat)
                            <option value="{{$dat->id }}">{{$dat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    {{ csrf_field()}}
                    <label for="type_injury">Typ zranenia</label>
                    <input type="text" class="form-control" name="type_injury" placeholder="Typ zranenia">
                </div>
                <div class="form-group">
                    <label for="approximately_time">Dlzka absencie</label>
                    <input type="text" class="form-control" name="approximately_time"  placeholder="Pocet dni">
                </div>

                <button type="submit" class="btn btn-primary">Odoslať</button>
            </form>

        </div>
    </div>

@endsection
