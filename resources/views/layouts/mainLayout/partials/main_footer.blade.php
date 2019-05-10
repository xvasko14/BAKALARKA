<div class="footer">
    <div class="container">
        <div class="copywrite">
            <p>© 2019  Design by Michal Vaško</a> </p>
        </div>
        <div class="footer-menu">
            <ul>
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
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>