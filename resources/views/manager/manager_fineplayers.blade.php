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
                    <button class="btn btn-success" type="submit">{{ __('message.search') }}</button>
                </div>
            </form>


            <h1 class="NadpisTabulky" align="center">{{ __('message.fine') }}</h1>

            <div class="panel-heading">
                <div class="">

                    <table id="rooms-table" class="table table-bordered table-striped table-condensed" border=1 width="400">
                        <thead>
                        <tr>
                            <th>{{ __('message.Player') }}</th>
                            <th>{{ __('message.reason') }}</th>
                            <th>{{ __('message.howmouch') }}</th>
                            <th>{{ __('message.paid') }}</th>

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
                                    <td><button id="green" onclick="location.href='{{route('manager_fine.in', $player->id)}}'"> {{ __('message.paid') }}</button></td>


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