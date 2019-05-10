<div class="footer">
    <div class="container">
        <div class="copywrite">
            <p>© 2019  Design by Michal Vaško</a> </p>
        </div>

        <div class="footer-menu">
            <ul>
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
                </ul>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>