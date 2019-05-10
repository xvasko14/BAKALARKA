<div class="header">
    <div class="container">

        <div class="logo">
            <h1><a href="/">{{ __('message.Uvod') }}</a></h1>
        </div>
        <div class="logo">
            <a class="furca"><img src="{{ asset('images/main_images/Haniska.jpg') }}" style="width:4em; height:3em;" ></a>
        </div>

        <div class="top-menu">
            <span class="menu"></span>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                <li><a href="/">{{ __('message.Home') }}</a></li>
                <li><a href="gallery">{{ __('message.galeria') }}</a></li>
                <li><a href="/club_Info">{{ __('message.Club') }}</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ __('message.StatisticTable') }} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <a class="dropdown-item" href="/leagueOverview">{{ __('message.LeagueTable') }}</a>
                        <a class="dropdown-item" href="/statisticsOverview">{{ __('message.PlayerStatistics') }}</a>
                    </ul>
                </li>
                <li><a href="/mygames">{{ __('message.Matches') }}</a></li>
                <li><a href="/player_home/login">{{ __('message.Player') }}</a></li>
                <li><a href="/manager_home/login">{{ __('message.Manager') }}</a></li>
                @guest

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