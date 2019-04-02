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

}
