@extends('layouts.mainLayout.main_layout')

@section('content')

<div class="container" style="max-width:90%;">
        {!! Form::open(['route' => 'contact.store']) !!}

        <div class="form-group">
            {!! Form::label('name', 'Your Name') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('email', 'E-mail Address') !!}
            {!! Form::text('email', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::textarea('msg', null, ['class' => 'form-control']) !!}
        </div>

        {!! Form::submit('Submit', ['class' => 'btn btn-info']) !!}

        {!! Form::close() !!}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

@endsection