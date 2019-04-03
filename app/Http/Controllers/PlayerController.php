<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Auth;

use App\Admin;
use App\Player;
use App\User;
use App\Manager;

class PlayerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:player');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // prechod z priecinku do player-home cez bodku
        return view('player.player_home');
    }


    public function myTraining()
    {
        $training = DB::table('training')->get();
        $teamstraining = DB::table('teams_training')->get();
        $data = [
            'training' => $training,
            'teams_training' => $teamstraining
        ];
        return view('player.player_training', $data);
    }

    public function JoinmyTraining( Request $request)
    {

        $user = Auth::user()->id;


        /*$trainings = DB::table('teams_training')
            ->insert(array(
        $user => $request->get('	playerTraining_id'),
       'id' => $request->get('	training_id'),


    ));

        $trainings->save();*/


       /* $trainings= DB::table('training')->get();

        $trainings->each(function(Qrcode $team_T) {
            DB::table('teams_training')
                ->where('id', $team_T->id)
                ->update([
                    'id' => $team_T->training_id
                ]);
        });


        return view('player.player_training');*/
    }

    public function myClub()
    {

        $user = Auth::user()->id;
        //var_dump($user); exit;



        $teams = DB::table('teams')
            ->select('teams.*')
            ->join('teamplayers', 'teams.id', '=', 'teamplayers.team_id')
            ->where('teamplayers.player_id', '=', $user)
            ->get();

       // $teams = DB::table('teamplayers')->where('id', $id)->first();
        // preco toto tak???  spytaj as jura

        // musi natvrdo este dat tabulku teams do premenej
        $data = [
            'teams' => $teams,
        ];



        //var_dump($teams); exit;
        return view('player.player_club', $data);
    }

    public function myClubInfo($id)
    {



        $players = DB::table('players')
            ->select('players.name','age','position')
            ->join('teamplayers', 'players.id', '=', 'teamplayers.player_id')
            ->join('teams', 'teams.id', '=', 'teamplayers.team_id')
            ->where('teams.id', '=', $id)
            ->get();


        $data = [
            'players' => $players,
        ];
        //var_dump($players); exit;

        return view('player.player_club_Info', $data);
    }





    public function LeagueOverview()
    {
        $league = DB::table('league')->get();
        $data = [
            'league' => $league,
        ];


        return view('player.player_leagueOverview', $data);
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

        return view('player.player_league', $data);

    }

}





