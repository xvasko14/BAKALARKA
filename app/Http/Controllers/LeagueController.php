<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;


class LeagueController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        //$this->middleware('auth:player');
    }


    public function LeagueOverview()
    {
        $league = DB::table('league')->get();
        $data = [
            'league' => $league,
        ];
        $dateOfBirth = '1994-07-02';



        return view('pages.leagueOverview', $data);
    }



    public function main($id)
    {




        // vyber ligy je natvrdo dany cislovkou asi zmenit !!!
        $teams = DB::table('teams')
            ->select('*')

            ->join('teams_in_league', 'teams.id', '=', 'teams_in_league.team_id')
            ->where('teams_in_league.league_id', '=', $id)
            ->get();

        foreach ($teams as $team) {
            $team->score = 0;
            $team->goals = 0;
            $team->goalsoponent = 0;
            $team->win = 0;
            $team->draw = 0;
            $team->lose = 0;
            $team->match = 0;


            //TODO
            // zatial nastavena sezona natvrdo
            $p = DB::table('game')->select('*')
                ->join('sezona', 'sezona.id', '=', 'game.sezona')
                ->where('game.sezona', '=', '1')
                ->where('team1', '=', $team->team_id)
                ->get();

            $p1 = DB::table('game')->select('*')
                ->join('sezona', 'sezona.id', '=', 'game.sezona')
                ->where('game.sezona', '=', '1')
                ->where('team2', '=', $team->team_id)
                ->get();

            foreach ($p as $pp) {
                if ($pp->team1_goals > $pp->team2_goals) {
                    $team->score += 3;
                    $team->win += 1;
                    $team->match += 1;

                }
                elseif ($pp->team1_goals == $pp->team2_goals) {
                    $team->score += 1;
                    $team->draw += 1;
                    $team->match += 1;
                }
                else {
                    $team->lose += 1;
                    $team->match += 1;

                }

                $team->goals += $pp->team1_goals;
                $team->goalsoponent += $pp->team2_goals;

            }

            foreach ($p1 as $pp) {
                if ($pp->team1_goals < $pp->team2_goals) {
                    $team->score += 3;
                    $team->win += 1;
                    $team->match += 1;
                }
                elseif ($pp->team1_goals == $pp->team2_goals) {
                    $team->score += 1;
                    $team->draw += 1;
                    $team->match += 1;
                }
                else {
                    $team->lose += 1;
                    $team->match += 1;

                }

                $team->goals += $pp->team2_goals;
                $team->goalsoponent += $pp->team1_goals;
            }
            //var_dump($team->score );exit;
            /* $arr= array ($team->score);
             sort($arr);
             //var_dump($arr);*/

            //usort($myArray, function($a, $b) {
            //     return $a['score'] => $b['score'];
            //});



        }

        $teams = $teams->toArray();
        usort($teams, function ($a, $b) {
            $comparison = strcmp($b->score, $a->score);
            // ak vrati 0, teda rozdiel je nulovy a body rovnake tak porovname podla golov
            if ($comparison == 0) {
                return strcmp($b->goals, $a->goals);
            }
            return $comparison;
        }

        );

        $data = [
            'teams' => $teams,
        ];


        return view('pages.league', $data);

    }

    // statistiky hracov v lige
    // zobrazi len ligy
    public function StatisticsOverview()
    {
        $league = DB::table('league')->get();
        $data = [
            'league' => $league,
        ];


        return view('pages.statisticsOveview', $data);
    }

    public function statistics_goal()
    {

        if(request()->has('search')) {
            $find = request('search');
            $pattern = ".*" . $find . ".*";
            $statistics = DB::table('players')
                ->select( DB::raw('players.id, players.name, players.date_of_birth, players.position, SUM(PlayerInGame.goals) as goals'))
                ->join('PlayerInGame', 'players.id', '=', 'PlayerInGame.playerGameID')
                ->join('teamplayers', 'teamplayers.player_id', '=', 'players.id')
                ->join('teams_in_league', 'teams_in_league.team_id', '=', 'teamplayers.team_id')
                // ->where('teams_in_league.league_id', '=', $id)
                ->where('players.name','REGEXP',$pattern)
                ->groupBy('players.id')
                ->groupBy('players.name')
                ->groupBy('players.date_of_birth')
                ->groupBy('players.position')
                ->orderBy('goals','desc ');
            $statistics= $statistics->paginate(10); }



        else {
            $statistics = DB::table('players')
                ->select( DB::raw('players.id, players.name, players.date_of_birth, players.position, SUM(PlayerInGame.goals) as goals'))
                ->join('PlayerInGame', 'players.id', '=', 'PlayerInGame.playerGameID')
                ->join('teamplayers', 'teamplayers.player_id', '=', 'players.id')
                ->join('teams_in_league', 'teams_in_league.team_id', '=', 'teamplayers.team_id')
                // ->where('teams_in_league.league_id', '=', $id)
                ->groupBy('players.id')
                ->groupBy('players.name')
                ->groupBy('players.date_of_birth')
                ->groupBy('players.position')
                ->orderBy('goals','desc ')
                ->paginate(10);
        }

        $data = [
            'statistics' => $statistics,
        ];

        return view('pages.statistics_goal', $data);

    }

    public function statistics_asists()
    {


        if(request()->has('search')) {
            $find = request('search');
            $pattern = ".*" . $find . ".*";
            $statistics = DB::table('players')
                ->select( DB::raw('players.id, players.name, players.date_of_birth, players.position, SUM(PlayerInGame.asists) as asists'))
                ->join('PlayerInGame', 'players.id', '=', 'PlayerInGame.playerGameID')
                ->join('teamplayers', 'teamplayers.player_id', '=', 'players.id')
                ->join('teams_in_league', 'teams_in_league.team_id', '=', 'teamplayers.team_id')
                // ->where('teams_in_league.league_id', '=', $id)
                ->where('players.name','REGEXP',$pattern)
                ->groupBy('players.id')
                ->groupBy('players.name')
                ->groupBy('players.date_of_birth')
                ->groupBy('players.position')
                ->orderBy('asists','desc ');
            $statistics= $statistics->paginate(10);


        }

        else {
            $statistics = DB::table('players')
                ->select( DB::raw('players.id, players.name, players.date_of_birth, players.position, SUM(PlayerInGame.asists) as asists'))
                ->join('PlayerInGame', 'players.id', '=', 'PlayerInGame.playerGameID')
                ->join('teamplayers', 'teamplayers.player_id', '=', 'players.id')
                ->join('teams_in_league', 'teams_in_league.team_id', '=', 'teamplayers.team_id')
                // ->where('teams_in_league.league_id', '=', $id)
                ->groupBy('players.id')
                ->groupBy('players.name')
                ->groupBy('players.date_of_birth')
                ->groupBy('players.position')
                ->orderBy('asists','desc ')
                ->paginate(10);

        }


        $data = [
            'statistics' => $statistics,
        ];

        return view('pages.statistics_asists', $data);

    }

    public function statistics_yellowC()
    {

        if(request()->has('search')) {
            $find = request('search');
            $pattern = ".*" . $find . ".*";
            $statistics = DB::table('players')
                ->select(DB::raw('players.id, players.name, players.date_of_birth, players.position, SUM(PlayerInGame.yellowCard) as yellowCard'))
                ->join('PlayerInGame', 'players.id', '=', 'PlayerInGame.playerGameID')
                ->join('teamplayers', 'teamplayers.player_id', '=', 'players.id')
                ->join('teams_in_league', 'teams_in_league.team_id', '=', 'teamplayers.team_id')
                // ->where('teams_in_league.league_id', '=', $id)
                ->where('players.name','REGEXP',$pattern)
                ->groupBy('players.id')
                ->groupBy('players.name')
                ->groupBy('players.date_of_birth')
                ->groupBy('players.position')
                ->orderBy('yellowCard', 'desc ');
            $statistics= $statistics->paginate(10);


        }

        else {

            $statistics = DB::table('players')
                ->select(DB::raw('players.id, players.name, players.date_of_birth, players.position, SUM(PlayerInGame.yellowCard) as yellowCard'))
                ->join('PlayerInGame', 'players.id', '=', 'PlayerInGame.playerGameID')
                ->join('teamplayers', 'teamplayers.player_id', '=', 'players.id')
                ->join('teams_in_league', 'teams_in_league.team_id', '=', 'teamplayers.team_id')
                // ->where('teams_in_league.league_id', '=', $id)
                ->groupBy('players.id')
                ->groupBy('players.name')
                ->groupBy('players.date_of_birth')
                ->groupBy('players.position')
                ->orderBy('yellowCard', 'desc ')
                ->paginate(10);

        }

        $data = [
            'statistics' => $statistics,
        ];

        return view('pages.statistics_yellowC', $data);

    }
    public function statistics_redC()
    {

        if(request()->has('search')) {
            $find = request('search');
            $pattern = ".*" . $find . ".*";
            $statistics = DB::table('players')
                ->select(DB::raw('players.id, players.name, players.date_of_birth, players.position, SUM(PlayerInGame.redCard) as redCard'))
                ->join('PlayerInGame', 'players.id', '=', 'PlayerInGame.playerGameID')
                ->join('teamplayers', 'teamplayers.player_id', '=', 'players.id')
                ->join('teams_in_league', 'teams_in_league.team_id', '=', 'teamplayers.team_id')
                // ->where('teams_in_league.league_id', '=', $id)
                ->where('players.name','REGEXP',$pattern)
                ->groupBy('players.id')
                ->groupBy('players.name')
                ->groupBy('players.date_of_birth')
                ->groupBy('players.position')
                ->orderBy('redCard', 'desc ');
            $statistics= $statistics->paginate(10);



        }

        else {

            $statistics = DB::table('players')
                ->select(DB::raw('players.id, players.name, players.date_of_birth, players.position, SUM(PlayerInGame.redCard) as redCard'))
                ->join('PlayerInGame', 'players.id', '=', 'PlayerInGame.playerGameID')
                ->join('teamplayers', 'teamplayers.player_id', '=', 'players.id')
                ->join('teams_in_league', 'teams_in_league.team_id', '=', 'teamplayers.team_id')
                // ->where('teams_in_league.league_id', '=', $id)
                ->groupBy('players.id')
                ->groupBy('players.name')
                ->groupBy('players.date_of_birth')
                ->groupBy('players.position')
                ->orderBy('redCard', 'desc ')
                ->paginate(10);
        }


        $data = [
            'statistics' => $statistics,
        ];

        return view('pages.statistics_redC', $data);

    }
    public function statistics_min()
    {

        if(request()->has('search')) {
            $find = request('search');
            $pattern = ".*" . $find . ".*";
            $statistics = DB::table('players')
                ->select(DB::raw('players.id, players.name, players.date_of_birth, players.position, SUM(PlayerInGame.min) as min'))
                ->join('PlayerInGame', 'players.id', '=', 'PlayerInGame.playerGameID')
                ->join('teamplayers', 'teamplayers.player_id', '=', 'players.id')
                ->join('teams_in_league', 'teams_in_league.team_id', '=', 'teamplayers.team_id')
                // ->where('teams_in_league.league_id', '=', $id)
                ->where('players.name','REGEXP',$pattern)
                ->groupBy('players.id')
                ->groupBy('players.name')
                ->groupBy('players.date_of_birth')
                ->groupBy('players.position')
                ->orderBy('min', 'desc ');
            $statistics= $statistics->paginate(10);


        }

        else {

            $statistics = DB::table('players')
                ->select(DB::raw('players.id, players.name, players.date_of_birth, players.position, SUM(PlayerInGame.min) as min'))
                ->join('PlayerInGame', 'players.id', '=', 'PlayerInGame.playerGameID')
                ->join('teamplayers', 'teamplayers.player_id', '=', 'players.id')
                ->join('teams_in_league', 'teams_in_league.team_id', '=', 'teamplayers.team_id')
                // ->where('teams_in_league.league_id', '=', $id)
                ->groupBy('players.id')
                ->groupBy('players.name')
                ->groupBy('players.date_of_birth')
                ->groupBy('players.position')
                ->orderBy('min', 'desc ')
                ->paginate(10);
        }
        $data = [
            'statistics' => $statistics,
        ];

        return view('pages.statistics_mins', $data);

    }


}
