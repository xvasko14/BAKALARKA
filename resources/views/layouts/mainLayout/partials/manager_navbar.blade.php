<div class="header">
    <div class="container">
        <div class="logo">
            <h1><a href="/manager_home">FutbalIS</a></h1>
        </div>
        <div class="top-menu">
            <span class="menu"></span>

            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li ><a href="/manager_home">Domov</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Moj klub <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <a href="/manager_home/manager_club">Moj klub</a>
                            <a class="dropdown-item" href="/manager_home/manager_injuryguide">Zranenia</a>
                            <a class="dropdown-item" href="/manager_home/manager_fineguide">Pokuty</a>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Tabuľký štatistík <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <a class="dropdown-item" href="/manager_home/manager_leagueOverview">Ligová tabuľka</a>
                            <a class="dropdown-item" href="/manager_home/manager_statisticsOverview">Štatistiky hráčov</a>
                        </ul>
                    </li>
                    <li><a href="/manager_home/manager_mygames">Naše zápasy</a></li>
                    <li><a href="/manager_home/manager_trainingguide">Tréning</a></li>



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