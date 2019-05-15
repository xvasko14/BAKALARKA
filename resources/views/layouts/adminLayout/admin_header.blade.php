<!--Header-part-->
<div id="header">
  <h1><a href="dashboard.html">Admin</a></h1>
</div>
<!--close-Header-part--> 


<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <!-- !!!!!!!!!!! podozrive chovanie neviem preco smeruje na home, asi to nie je uplne koretkne fugovanie logoutu !!!!!!!!!!!! -->
    <li class=""><a title="" href="{{ route('logout') }}"onclick="event.preventDefault();
   document.getElementById('logout-form').submit();"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a>
    </li>

  </ul>

   <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
 @csrf
 </form>
</div>
<!--close-top-Header-menu-->
<!--start-top-serch-->

<!--close-top-serch--

