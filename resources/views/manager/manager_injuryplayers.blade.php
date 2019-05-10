@extends('layouts.mainLayout.manager_layout')

@section('content')


    <div class="container" style="max-width:90%;">
        <div class="row">

            <form class="form-inline" action="{{ route('manager_injuryplayers.main')}}" method="get">
                <div class="form-group">
                    {{ csrf_field()}}
                    <input type="text" class="form-control" name="search" placeholder="Meno hráča">
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit">Vyhľadať</button>
                </div>
            </form>


            <h1 class="NadpisTabulky" align="center">Zraneni v time</h1>

            <div class="panel-heading">
                <div class="">

                    <table id="rooms-table" class="table table-bordered table-striped table-condensed" border=1 width="400">
                        <colgroup>
                            <col class="grey" />
                        </colgroup>
                        <thead>
                        <tr>
                            <th>Hraci</th>
                            <th>Typ</th>
                            <th>Dlzka</th>
                            <th>Zraneni</th>
                            <th>Vylieceni</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($players as $player)
                            <tr>
                                @if ($player->injury_status)
                                    <td id="kolonka_green" >{{$player->name}}</td>
                                @else
                                    <td id="kolonka_red" >{{$player->name}}</td>
                                @endif
                                <td> {{$player->type_injury}}</td>
                                <td>{{$player->approximately_time}}</td>
                                <td><button id="bordeaux" onclick="location.href='{{route('manager_injury.delete', $player->id)}}'">Zraneni </button></td>
                                <td><button id="green" onclick="location.href='{{route('manager_injury.in', $player->id)}}'"> Zotaveny</button></td>
                                {{--<script>--}}
                                    {{--function createCookie(name,value,days) {--}}
                                        {{--if (days) {--}}
                                            {{--var date = new Date();--}}
                                            {{--date.setTime(date.getTime()+(days*24*60*60*1000));--}}
                                            {{--var expires = "; expires="+date.toGMTString();--}}
                                        {{--}--}}
                                        {{--else var expires = "";--}}
                                        {{--document.cookie = name+"="+value+expires+"; path=/";--}}
                                    {{--}--}}

                                    {{--function readCookie(name) {--}}
                                        {{--var nameEQ = name + "=";--}}
                                        {{--var ca = document.cookie.split(';');--}}
                                        {{--for(var i=0;i < ca.length;i++) {--}}
                                            {{--var c = ca[i];--}}
                                            {{--while (c.charAt(0)==' ') c = c.substring(1,c.length);--}}
                                            {{--if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);--}}
                                        {{--}--}}
                                        {{--return null;--}}
                                    {{--}--}}

                                    {{--function eraseCookie(name) {--}}
                                        {{--createCookie(name,"",-1);--}}
                                    {{--}--}}


                                    {{--//Your code here!--}}
                                    {{--document.getElementById("green").onclick = function() {colorGreen()};--}}
                                    {{--document.getElementById("bordeaux").onclick = function() {colorBordeaux()};--}}
                                    {{--var x = readCookie('color')--}}
                                    {{--if (x === 'green') {--}}
                                        {{--colorGreen();--}}
                                    {{--} else if(x === 'bordeaux'){--}}
                                        {{--colorBordeaux();--}}
                                    {{--}--}}

                                    {{--function colorGreen() {--}}
                                        {{--document.getElementById("kolonka").style.color = " #448F44";--}}
                                        {{--createCookie('color','green',7);--}}
                                    {{--}--}}
                                    {{--function colorBordeaux() {--}}

                                        {{--document.getElementById("kolonka").style.color = " #E8920C";--}}
                                        {{--createCookie('color','bordeaux',7);--}}
                                    {{--}--}}
                                {{--</script>--}}

                        @endforeach
                        </tbody>
                    </table>
                    {{ $players->links() }}


                </div>
            </div>

        </div>
    </div>


@endsection