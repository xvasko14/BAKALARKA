@extends('layouts.mainLayout.manager_layout')

@section('content')

    <div class="container" style="max-width:80%; margin-top: 40px;">
        <form action="{{ route('manager_fine_insert.main') }}" method="post">
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
                <label for="reason">{{ __('message.reason') }}</label>
                <input type="text" class="form-control" name="reason" placeholder="{{ __('message.reason') }}">
            </div>
            <div class="form-group">
                <label for="sum">{{ __('message.howmouch') }}</label>
                <input type="text" class="form-control" name="sum"  placeholder="{{ __('message.euro') }}">
            </div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                <br>
            @endif
            <button type="submit" class="btn btn-primary">{{ __('message.send') }}</button>
            </div>
          </div>
    </div>
        </form>


    </div>



@endsection
