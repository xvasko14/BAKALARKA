@extends('layouts.mainLayout.manager_layout')

@section('content')


        <div class="container" style="max-width:80%; margin-top: 40px;">
            <form action="{{ route('manager.training.insertTraining') }}" method="post">
                <div class="row">
                    <div class="col-lg-4 col-lg-offset-4">
                        <div class="form-group">
                            {{ csrf_field()}}
                            <label for="starts">{{ __('message.squadtrainingstarts') }}</label>
                            <input type="time" class="form-control" name="time" placeholder="{{ __('message.squadtrainingstarts') }}">
                        </div>
                        <div class="form-group">
                            {{ csrf_field()}}
                            <label for="starts">{{ __('message.matchdate') }}</label>
                            <input type="date" class="form-control" name="date" placeholder="{{ __('message.matchdate') }}">
                        </div>
                        <div class="form-group">
                            {{ csrf_field()}}
                            <label for="specialization">{{ __('message.squadtrainingfocu') }}</label>
                            <input type="text" class="form-control" name="specialization" placeholder="{{ __('message.squadtrainingfocu') }}">
                        </div>
                        <div class="form-group">
                            <label for="length">{{ __('message.squadtraininglenghts') }}</label>
                            <input type="text" class="form-control" name="length"  placeholder="{{ __('message.squadtraininglenghts') }}">
                        </div>
                        <div class="form-group">
                            <label for="club">{{ __('message.Club') }}</label>
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
                        <button type="submit" class="btn btn-primary">{{ __('message.send') }}</button>
                    </div>
                </div>

            </form>

        </div>
    </div>


@endsection
