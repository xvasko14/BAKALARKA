<?php

namespace App\Http\Controllers;

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


            $p = DB::table('game')->select('*')
                ->where('team1', '=', $team->team_id)
                ->get();

            $p1 = DB::table('game')->select('*')
                ->where('team2', '=', $team->team_id)
                ->get();

            foreach ($p as $pp) {
                if ($pp->team1_goals > $pp->team2_goals) {
                    $team->score += 3;
                }
                elseif ($pp->team1_goals == $pp->team2_goals) {
                    $team->score += 1;
                }

                $team->goals += $pp->team1_goals;
            }

            foreach ($p1 as $pp) {
                if ($pp->team1_goals < $pp->team2_goals) {
                    $team->score += 3;
                }
                elseif ($pp->team1_goals == $pp->team2_goals) {
                    $team->score += 1;
                }

                $team->goals += $pp->team2_goals;
            }

            $collection = collect([
                ['team' => 'score'],
            ]);
            $sorted = $collection->sortBy('score');

            $sorted->values()->all();

        }


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

        $statistics = DB::table('players')
            ->select( DB::raw('players.id, players.name, players.age, players.position, SUM(PlayerInGame.goals) as goals, SUM(PlayerInGame.redCard) as rcard'))
            ->join('PlayerInGame', 'players.id', '=', 'PlayerInGame.playerGameID')
            ->join('teamplayers', 'teamplayers.player_id', '=', 'players.id')
            ->join('teams_in_league', 'teams_in_league.team_id', '=', 'teamplayers.team_id')
            // ->where('teams_in_league.league_id', '=', $id)
            ->groupBy('players.id')
            ->groupBy('players.name')
            ->groupBy('players.age')
            ->groupBy('players.position')
            ->orderBy('goals','desc ')
            //->orderBy('rcard','desc ')
            ->get();


        $data = [
            'statistics' => $statistics,
        ];

        return view('pages.statistics_goal', $data);

    }

    public function statistics_asists()
    {

        $statistics = DB::table('players')
            ->select( DB::raw('players.id, players.name, players.age, players.position, SUM(PlayerInGame.asists) as asists'))
            ->join('PlayerInGame', 'players.id', '=', 'PlayerInGame.playerGameID')
            ->join('teamplayers', 'teamplayers.player_id', '=', 'players.id')
            ->join('teams_in_league', 'teams_in_league.team_id', '=', 'teamplayers.team_id')
            // ->where('teams_in_league.league_id', '=', $id)
            ->groupBy('players.id')
            ->groupBy('players.name')
            ->groupBy('players.age')
            ->groupBy('players.position')
            ->orderBy('asists','desc ')
            ->get();


        $data = [
            'statistics' => $statistics,
        ];

        return view('pages.statistics_asists', $data);

    }

    public function statistics_yellowC()
    {

        $statistics = DB::table('players')
            ->select( DB::raw('players.id, players.name, players.age, players.position, SUM(PlayerInGame.yellowCard) as yellowCard'))
            ->join('PlayerInGame', 'players.id', '=', 'PlayerInGame.playerGameID')
            ->join('teamplayers', 'teamplayers.player_id', '=', 'players.id')
            ->join('teams_in_league', 'teams_in_league.team_id', '=', 'teamplayers.team_id')
            // ->where('teams_in_league.league_id', '=', $id)
            ->groupBy('players.id')
            ->groupBy('players.name')
            ->groupBy('players.age')
            ->groupBy('players.position')
            ->orderBy('yellowCard','desc ')
            ->get();


        $data = [
            'statistics' => $statistics,
        ];

        return view('pages.statistics_yellowC', $data);

    }
    public function statistics_redC()
    {

        $statistics = DB::table('players')
            ->select( DB::raw('players.id, players.name, players.age, players.position, SUM(PlayerInGame.redCard) as redCard'))
            ->join('PlayerInGame', 'players.id', '=', 'PlayerInGame.playerGameID')
            ->join('teamplayers', 'teamplayers.player_id', '=', 'players.id')
            ->join('teams_in_league', 'teams_in_league.team_id', '=', 'teamplayers.team_id')
            // ->where('teams_in_league.league_id', '=', $id)
            ->groupBy('players.id')
            ->groupBy('players.name')
            ->groupBy('players.age')
            ->groupBy('players.position')
            ->orderBy('redCard','desc ')
            ->get();


        $data = [
            'statistics' => $statistics,
        ];

        return view('pages.statistics_redC', $data);

    }
    public function statistics_min()
    {

        $statistics = DB::table('players')
            ->select( DB::raw('players.id, players.name, players.age, players.position, SUM(PlayerInGame.min) as min'))
            ->join('PlayerInGame', 'players.id', '=', 'PlayerInGame.playerGameID')
            ->join('teamplayers', 'teamplayers.player_id', '=', 'players.id')
            ->join('teams_in_league', 'teams_in_league.team_id', '=', 'teamplayers.team_id')
            // ->where('teams_in_league.league_id', '=', $id)
            ->groupBy('players.id')
            ->groupBy('players.name')
            ->groupBy('players.age')
            ->groupBy('players.position')
            ->orderBy('min','desc ')
            ->get();


        $data = [
            'statistics' => $statistics,
        ];

        return view('pages.statistics_mins', $data);

    }


}
