<div class="footer">
    <div class="container">
        <div class="copywrite">
            <p>© 2019  Design by Michal Vaško</a> </p>
        </div>
        <div class="footer-menu">
            <ul>
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
                </ul>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>