@extends('layouts.manager_layout')

@section('content')


    <div class="container" style="max-width:80%; margin-top: 40px;">
        <form action="{{ route('manager_fine_insert.main') }}" method="post">
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
                <label for="reason">Dovod pokuty</label>
                <input type="text" class="form-control" name="reason" placeholder="Dovod pokuty">
            </div>
            <div class="form-group">
                <label for="sum">Ciastka</label>
                <input type="text" class="form-control" name="sum"  placeholder="V eurach">
            </div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                <br>
            @endif
            <button type="submit" class="btn btn-primary">Odoslať</button>
    </div>
    </form>

    </div>



@endsection
