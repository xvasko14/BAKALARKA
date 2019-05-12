@extends('layouts.mainLayout.manager_layout')

@section('content')

<div class="container" style="max-width:90%;">


     <h1 class="NadpisTabulky" align="center">{{ __('message.lossincome') }}</h1>
     <div class="container" style="max-width:80%; margin-top: 40px;">
        <form action="{{ route('storeM') }}" method="post">
            {{csrf_field()}}
            <div class="row">
                <div class="col-lg-4 col-lg-offset-4">
                    <div class="form-group">
                        {{ csrf_field()}}
                        <label for="Datum">{{ __('message.matchdate') }}:</label>
                        <input type="date" class="form-control" id="Datum" name="Datum">
                    </div>
                    <div class="form-group">
                        <label for="nazov">{{ __('message.nazov') }}:</label>
                        <input type="text" class="form-control" id="Nazov" name="Nazov">
                    </div>
                    <div class="form-group">
                        <label for="Prijem">{{ __('message.income') }}:</label>
                        <input type="text" class="form-control" id="Prijem" name="Prijem">
                    </div>
                    <div class="form-group">
                        <label for="Vydavok">{{ __('message.loss') }}:</label>
                        <input type="text" class="form-control" id="Vydavok" name="Vydavok">
                    </div>

                    <button type="submit" class="btn btn-primary">{{ __('message.send') }}</button>
            </div>
        </div>
    </form>
 </div>
</div>





@endsection