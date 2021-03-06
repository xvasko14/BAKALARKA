@extends('layouts.mainLayout.main_layout')

@section('content')
    <div class="container" style="max-width:90%;">
        <div class="row">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="/">{{ __('message.Home') }}</a></li>
                    <li class="active">{{ __('message.Club') }}</li>
                </ol>
            </div>


            <form class="form-inline" action="{{ route('club_Info.main')}}" method="get">
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

                    <table id="rooms-table" class="table table-bordered table-striped table-condensed" border=1 width="400">
                        <thead>
                        <tr>
                            <th><a href="{{ route('club_Info.main', ['name' => request('name'), 'sort' => 'asc'])}}"><i class="fas fa-sort-up"></i></a>
                                {{ __('message.players') }}
                                <a href="{{ route('club_Info.main', ['name' => request('name'), 'sort' => 'desc'])}}"><i class="fas fa-sort-down"></i></a></th>
                            <th><a href="{{ route('club_Info.main', ['date_of_birth' => request('date_of_birth'), 'sort_age' => 'asc'])}}"><i class="fas fa-sort-up"></i></a>
                                {{ __('message.age') }}
                                <a href="{{ route('club_Info.main', ['date_of_birth' => request('date_of_birth'), 'sort_age' => 'desc'])}}"><i class="fas fa-sort-down"></i></a>
                            </th>
                            <th><a href="{{ route('club_Info.main', ['position' => request('position'), 'sort_position' => 'asc'])}}"><i class="fas fa-sort-up"></i></a>
                                {{ __('message.position') }}
                                <a href="{{ route('club_Info.main', ['position' => request('position'), 'sort_position' => 'desc'])}}"><i class="fas fa-sort-down"></i></a>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($players as $player)
                            <tr>
                                <td> <a  href="{{route('club_InfoPlayer.main', $player->id)}}">{{ $player->name}}</a></td>
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


