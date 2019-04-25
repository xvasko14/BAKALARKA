<div class="header">
    <div class="container">
        <div class="logo">
            <h1><a href="/">FUTBAL</a></h1>
        </div>
        <div class="top-menu">
            <span class="menu"></span>
            <ul>
                <li class="active"><a href="/">HOME</a></li>
                <li><a href="gallery">GALERIA</a></li>
                <li><a href="leagueOverview">LIGOVA TABULKA</a></li>
                <li><a href="/player_home/login">HRAC</a></li>
                <li><a href="/manager_home/login">TRENER</a></li>
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