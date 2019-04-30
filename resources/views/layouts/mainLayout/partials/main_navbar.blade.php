<div class="header">
    <div class="container">
        <div class="logo">
            <h1><a href="/">FUTBAL</a></h1>
        </div>
        <div class="top-menu">
            <span class="menu"></span>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                <li><a href="/">Domov</a></li>
                <li><a href="gallery">Galéria</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Tabuľký štatistík <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <a class="dropdown-item" href="/leagueOverview">Ligová tabuľka</a>
                        <a class="dropdown-item" href="/statisticsOverview">Štatistiky hráčov</a>
                    </ul>
                </li>
                <li><a href="/player_home/login">Hráč</a></li>
                <li><a href="/manager_home/login">Tréner</a></li>
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