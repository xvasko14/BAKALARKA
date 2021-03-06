@extends('layouts.mainLayout.main_layout')

@section('content')


    <div class="container" style="max-width:90%;">
        <div class="row">

            <form class="form-inline" action="{{ route('statistics_yellowC.main')}}" method="get">
                <div class="form-group">
                    {{ csrf_field()}}
                    <input type="text" class="form-control" name="search" placeholder="{{ __('message.Player') }}">
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit">{{ __('message.search') }}</button>
                </div>
            </form>

            <h1 class="NadpisTabulky" align="center">{{ __('message.mosty') }}</h1>

            <div  class="panel-heading">
                <div class="">

                    <table id="rooms-table" class="table table-bordered table-striped table-condensed" border=1 width="400">
                        <thead>
                        <tr>
                            <th>{{ __('message.Player') }}</th>
                            <th>{{ __('message.age') }}</th>
                            <th>{{ __('message.position') }}</th>
                            <th>{{ __('message.yellowC') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($statistics as $statistic)
                            <tr>
                                <td>{{$statistic->name}}</td>
                                <td>{{\Carbon\Carbon::parse($statistic->date_of_birth)->diff(\Carbon\Carbon::now())->format('%y ')}}</td>
                                <td>{{$statistic->position}}</td>
                                <td>{{$statistic->yellowCard}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{ $statistics->links() }}

                </div>

            </div>
        </div>
    </div>
        <script>
            var table = document.getElementsByTagName('table')[0],
                rows = table.getElementsByTagName('tr'),
                text = 'textContent' in document ? 'textContent' : 'innerText';

            for (var i = 0, len = rows.length; i < len; i++){
                rows[i].children[0][text] = i + '.' + rows[i].children[0][text];
            }
        </script>

@endsection