@extends('layouts.mainLayout.player_layout')

@section('content')
    <div class="container" style="max-width:90%;">
        <div class="row">


            <div class="panel panel-default">
                <h1 align="center">Ligova tabulka</h1>

                <div class="panel-heading">
                    <div class="">

                        <table id="rooms-table" class="table  table-striped table-dark " border=1 width="400">
                            <thead>
                            <tr>
                                <th>Tim</th>
                                <th>Zapasy</th>
                                <th>Strelene Goly</th>
                                <th>Obrdzane Goly</th>
                                <th>Vyhry</th>
                                <th>Remizi</th>
                                <th>Prehry</th>
                                <th>Body</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($teams as $key => $data)
                                <tr>
                                    <th>{{$data->name}}</th>
                                    <th>{{$data->match}}</th>
                                    <th>{{$data->goals}}</th>
                                    <th>{{$data->goalsoponent}}</th>
                                    <th>{{$data->win}}</th>
                                    <th>{{$data->draw}}</th>
                                    <th>{{$data->lose}}</th>
                                    <th>{{$data->score}}</th>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
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