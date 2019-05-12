<div class="header">
    <div class="container">
        <div class="logo">
            <h1><a href="/player_home">FutbalIS</a></h1>
        </div>

        <div class="logo">
            <a class="furca"><img src="{{ asset('images/main_images/furcaH.jpg') }}" style="width:4em; height:3em;" ></a>
        </div>

        <div class="top-menu">
            <span class="menu"></span>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li ><a href="/player_home">{{ __('message.Home') }}</a></li>

                    <li><a  href="/player_home/player_club_Info">{{ __('message.Player') }}</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ __('message.StatisticTable') }} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <a class="dropdown-item" href="/player_home/player_leagueOverview">{{ __('message.LeagueTable') }}</a>
                            <a class="dropdown-item" href="/player_home/player_statisticsOverview">{{ __('message.PlayerStatistics') }}</a>
                        </ul>
                    </li>
                    <li><a href="/player_home/player_mygames">{{ __('message.Matches') }}</a></li>
                    <li><a href="/player_home/player_training">{{ __('message.squadtraining') }}</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ __('message.finance') }}  <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <a class="dropdown-item" href="/player_home/finance_view">{{ __('message.financecelkove') }}</a>
                            <a class="dropdown-item" href="/player_home/finance_lost">{{ __('message.financecelkovelost') }}</a>
                        </ul>
                    </li>

                    <style>
                        div.topcorner {
                            position:absolute;
                            top:0;
                            right:0;
                        }
                    </style>

                    <div class="topcorner">
                        <a style="color: green" href="{{ url('locale/sk') }}" ><i  class="fa fa-flag"></i> SK</a>
                        <a style="color: red" href="{{ url('locale/en') }}" ><i class="fa fa-flag"></i> EN</a>

                    </div>

                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    </li>
                @else


                    <li class="nav-item dropdown">

                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>


                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
            </div>



        </div>
        <!-- script-for-menu -->
        <script>
            $("span.menu").click(function(){
                $(".top-menu ul").slideToggle("slow" , function(){
                });
            });
        </script>
        <!-- script-for-menu -->

        <div class="clearfix"></div>
    </div>
</div>