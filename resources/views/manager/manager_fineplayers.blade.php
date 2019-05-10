@extends('layouts.mainLayout.manager_layout')

@section('content')

    <div class="container" style="max-width:90%;">
        <div class="row">

            <form class="form-inline" action="{{ route('manager_fineplayers.main')}}" method="get">
                <div class="form-group">
                    {{ csrf_field()}}
                    <input type="text" class="form-control" name="search" placeholder="Meno hráča">
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit">Vyhľadať</button>
                </div>
            </form>


            <h1 class="NadpisTabulky" align="center">Pokuty</h1>

            <div class="panel-heading">
                <div class="">

                    <table id="rooms-table" class="table table-bordered table-striped table-condensed" border=1 width="400">
                        <thead>
                        <tr>
                            <th>Hrac</th>
                            <th>Dovod</th>
                            <th>Suma</th>
                            <th>Hrac zaplatil pokutu</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($players as $player)
                            <tr>
                                @if ($player->fine_pay)
                                    <td id="kolonka_green" >{{$player->name}}</td>
                                @else
                                    <td id="kolonka_red" >{{$player->name}}</td>
                                @endif
                                <td>{{$player->reason}}</td>
                                <td>{{$player->sum}}</td>
                                    <td><button id="green" onclick="location.href='{{route('manager_fine.in', $player->id)}}'"> Zaplatene</button></td>


                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $players->links() }}

                </div>
            </div>

        </div>
    </div>


@endsection