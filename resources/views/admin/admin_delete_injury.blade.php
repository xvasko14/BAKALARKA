@extends('layouts.adminLayout.admin_design')
@section('obsah')



    <div id="content">

        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ url('/admin') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
        </div>

        <div class="container" style="max-width:80%; margin-top: 40px;">
            <form action="{{ route('admin.injury.deleteInjury',$injuries->id) }}" method="post">
                <div class="form-group">
                    <label for="club">Hráč</label>
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
                    <input type="text" class="form-control" name="type_injury" placeholder="Typ zranenia" value="{{$injuries->type_injury}}">
                </div>
                <div class="form-group">
                    <label for="approximately_time">Dlžka absencie</label>
                    <input type="text" class="form-control" name="approximately_time"  placeholder="Počet dní" value="{{$injuries->approximately_time}}">
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
