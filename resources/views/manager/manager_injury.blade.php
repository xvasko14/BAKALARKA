@extends('layouts.mainLayout.manager_layout')

@section('content')



    <h1 class="NadpisTabulky" align="center">{{ __('message.createinjury') }}</h1>
    <div class="container" style="max-width:80%; margin-top: 40px;">

        <form action="{{ route('manager_injury_insert.main') }}" method="post">
            <div class="okno">
                @if (session('status'))
                    <div class="alert alert-warning alert-dismissible fade in text-center">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-4">
            <div class="form-group">
                <label for="club">{{ __('message.Player') }}</label>
                <!--<input type="text" class="form-control" name="club" aria-describedby="club placeholder="Enter Klub:string">-->
                <select name="player">
                    @foreach ($players as $dat)
                        <option value="{{$dat->id }}">{{$dat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                {{ csrf_field()}}
                <label for="type_injury">{{ __('message.type') }}</label>
                <input type="text" class="form-control" name="type_injury" placeholder="{{ __('message.type') }}">
            </div>
            <div class="form-group">
                <label for="approximately_time">{{ __('message.squadtraininglenghts') }}</label>
                <input type="number" class="form-control" name="approximately_time"  placeholder="{{ __('message.days') }}">
            </div>

            <button type="submit" class="btn btn-primary">{{ __('message.send') }}</button>
            </div>
        </form>
    </div>
    </div>

    </div>



@endsection
