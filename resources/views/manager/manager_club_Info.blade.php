@extends('layouts.mainLayout.manager_layout')

@section('content')

    <div class="container" style="max-width:90%;">
        <div class="row">

            <form class="form-inline" action="{{ route('manager_club_Info.main')}}" method="get">
                <div class="form-group">
                    {{ csrf_field()}}
                    <input type="text" class="form-control" name="search" placeholder="{{ __('message.Player') }}">
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit">{{ __('message.search') }}</button>
                </div>
            </form>


            <h1 class="NadpisTabulky" align="center">{{ __('message.teamsupiska') }}</h1>

            <div class="panel-heading">
                <div class="">
                    <div class="col-md-6 col-md-offset-0">


                        <a href="{{ route('manager_club_Info.main',  $player->id,['name' => request('name'), 'sort' => 'asc'])}}"><i class="fas fa-arrow-circle-up"><</i></a>
                        <a style="margin-left:15px;" href="{{ route('manager_club_Info.main',  $player->id,['name' => request('name'), 'sort' => 'dsc'])}}"><i class="mdi mdi-sort-descending"></i></a>

                    </div>
                    </div>

                    <table id="rooms-table" class="table table-bordered table-striped table-condensed" border=1 width="400">
                        <thead>
                        <tr>
                            <th>{{ __('message.players') }}</th>
                            <th>{{ __('message.age') }}</th>
                            <th>{{ __('message.position') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($players as $player)
                            <tr>
                                <td> <a  style="color: #1d643b" href="{{route('manager_club_InfoPlayer.main', $player->id)}}">{{ $player->name}}</a></td>
                                <td>{{\Carbon\Carbon::parse($player->date_of_birth)->diff(\Carbon\Carbon::now())->format('%y ')}}</td>
                                <td>{{$player->position}}</td>
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

