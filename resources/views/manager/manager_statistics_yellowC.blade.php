@extends('layouts.mainLayout.manager_layout')

@section('content')
    <div class="container" style="max-width:90%;">
        <div class="row">


            <h1 class="NadpisTabulky" align="center">Najviac ziskaných žltých kariet</h1>

            <div class="panel-heading">
                <div class="">

                    <table id="rooms-table" class="table table-bordered table-striped table-condensed" border=1 width="400">
                        <thead>
                        <tr>
                            <th>Hraci</th>
                            <th>Vek</th>
                            <th>Pozicia</th>
                            <th>Zlte karty</th>
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

