<div class="header">
    <div class="container">
        <div class="logo">
            <h1><a href="/manager_home">FutbalIS</a></h1>
        </div>

        <div class="logo">
            <a class="furca"><img src="{{ asset('images/main_images/furcaH.jpg') }}" style="width:4em; height:3em;" ></a>
        </div>

        <div class="top-menu">
            <span class="menu"></span>

            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li ><a href="/manager_home">{{ __('message.Home') }}</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ __('message.Club') }}<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <a class="dropdown-item" href="/manager_home/manager_club_Info">{{ __('message.Club') }}</a>
                            <a class="dropdown-item" href="/manager_home/manager_injuryguide">{{ __('message.injury') }}</a>
                            <a class="dropdown-item" href="/manager_home/manager_fineguide">{{ __('message.fine') }}</a>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ __('message.StatisticTable') }}  <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <a class="dropdown-item" href="/manager_home/manager_leagueOverview">{{ __('message.LeagueTable') }}</a>
                            <a class="dropdown-item" href="/manager_home/manager_statisticsOverview">{{ __('message.PlayerStatistics') }}</a>
                        </ul>
                    </li>
                    <li><a href="/manager_home/manager_mygames">{{ __('message.Matches') }}</a></li>
                    <li><a href="/manager_home/manager_trainingguide">{{ __('message.squadtraining') }}</a></li>




            <!--/.nav-collapse -->


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