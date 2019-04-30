<!--sidebar-menu--https://fontawesome.com/icons/male?style=solid teito ikonky som POUZIL-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li class="submenu" ><a href="#"><i class="fas fa-male"></i> <span>Players</span><span class="label label-important"></span></a> 
    <ul>
        <li><a href="{{ url('/admin/admin_insert_player') }}">Create Players</a></li>
        <li><a href="{{ url('/admin/admin_list_player') }}">List of  Players</a></li>
      </ul>
    <li class="submenu"> <a href="#"><i class="fas fa-male"></i> <span>Managers</span><span class="label label-important"></span></a> 
      <ul>
        <li><a href="{{ url('/admin/admin_insert_manager') }}">Create Managers</a></li>
        <li><a href="{{ url('/admin/admin_list_manager') }}">List of Managers</a></li>
      </ul>
    <li class="submenu" ><a href="#"><i class="fas fa-futbol"></i> <span>Teams</span><span class="label label-important"></span></a>
    <ul>
        <li><a href="{{ url('/admin/admin_insert_team') }}">Create Team</a></li>
        <li><a href="{{ url('/admin/admin_list_team') }}">List of Teams</a></li>
      </ul>
    </li>
    <li class="submenu" ><a href="#"><i class="fas fa-futbol"></i> <span>Leagues</span><span class="label label-important"></span></a>
      <ul>
        <li><a href="{{ url('/admin/admin_insert_league') }}">Create League</a></li>
        <li><a href="{{ url('/admin/admin_list_league') }}">List of Leagues</a></li>
      </ul>
    </li>
    <li class="submenu" ><a href="#"><i class="fas fa-futbol"></i> <span>Games</span><span class="label label-important"></span></a>
      <ul>
        <li><a href="{{ url('/admin/admin_insert_game') }}">Create Games</a></li>
        <li><a href="{{ url('/admin/admin_list_games') }}">List Games</a></li>
      </ul>
    </li>
    <li class="submenu" ><a href="#"><i class="fas fa-futbol"></i> <span>Player in Game</span><span class="label label-important"></span></a>
      <ul>
        <li><a href="{{ url('/admin/admin_insert_PlayerInGame_match') }}">Create formation</a></li>
      </ul>
    </li>
    <li class="submenu" ><a href="#"><i class="fas fa-bolt"></i> <span>Training</span><span class="label label-important"></span></a>
      <ul>
        <li><a href="{{ url('/admin/admin_insert_training') }}">Create Training</a></li>
        <li><a href="{{ url('/admin/admin_list_training') }}">List Training</a></li>
      </ul>
    </li>
    <li class="submenu" ><a href="#"><i class="fas fa-bolt"></i> <span>Fine</span><span class="label label-important"></span></a>
      <ul>
        <li><a href="{{ url('/admin/admin_insert_fine') }}">Create Fine</a></li>
        <li><a href="{{ url('/admin/admin_list_fine') }}">List Fine</a></li>
      </ul>
    </li>
    <li class="submenu" ><a href="#"><i class="fas fa-bolt"></i> <span>Injuries</span><span class="label label-important"></span></a>
      <ul>
        <li><a href="{{ url('/admin/admin_insert_injury') }}">Create Injuries</a></li>
        <li><a href="{{ url('/admin/admin_list_injury') }}">List Injury</a></li>
      </ul>
    </li>
  </ul>
</div>
<!--sidebar-menu-->