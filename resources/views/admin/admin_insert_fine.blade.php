@extends('layouts.adminLayout.admin_design')
@section('obsah')



    <div id="content">

        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ url('/admin') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
        </div>

        <div class="container" style="max-width:80%; margin-top: 40px;">
            <form action="{{ route('admin.fine.insertFine') }}" method="post">
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
                    <label for="reason">Dôvod pokuty</label>
                    <input type="text" class="form-control" name="reason" placeholder="Dôvod pokuty">
                </div>
                <div class="form-group">
                    <label for="sum">Čiastka</label>
                    <input type="text" class="form-control" name="sum"  placeholder="V eurach">
                </div>

                <button type="submit" class="btn btn-primary">Odoslať</button>
            </form>

        </div>
    </div>

@endsection
