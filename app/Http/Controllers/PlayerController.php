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
        $user = Auth::user()->id;

        // nacitame timy usera
        $teams = DB::table('teams')
            ->select('teams.*')
            ->join('teamplayers', 'teams.id', '=', 'teamplayers.team_id')
            ->where('teamplayers.player_id', '=', $user)
            ->first();



        // nacitame trening a potom vyberieme treningy timu
        // TODO len dopisat ze pre ktory
        $training = DB::table('training')
            ->select('*')
            ->where('teamTraining_id', '=', $teams->id)
            ->get();

        $teamstraining = DB::table('teams_training')
            ->select('*')
            ->where('teams_training.playerTraining_id', '=', $user)
            ->get();


        foreach ($training as $train)
        {
            $train->signed = 0;
            foreach ($teamstraining as $teamstrain)
            {   // porovname ci take id uz je tam
                if ($train->id == $teamstrain->training_id)
                {
                    $train->signed = 1;
                }
            }
        }
        $data = [
            'training' => $training,
            'teams_training' => $teamstraining
        ];


        return view('player.player_training', $data);
    }

    public function JoinMyTraining(  $id)
    {

        $user = Auth::user()->id;


        $remove = DB::table('teams_training')
            ->insert(array(
        'playerTraining_id' => $user,
        'training_id' => $id,


    ));

        return redirect('player_home/player_training');
    }


    public function RemoveMyTraining(  $id)
    {

        $user = Auth::user()->id;


        $trainings = DB::table('teams_training')
            ->select('id')
            ->where('training_id', '=', $id)
            ->where('playerTraining_id','=', $user)
            ->delete();



        return redirect('player_home/player_training');
    }

    // hraci ktory su na treningu
    public function PlayerInTraining($id)
    {



        $players = DB::table('players')
            ->select('players.name','age','position')
            ->join('teams_training', 'players.id', '=', 'teams_training.playerTraining_id')
            ->join('training', 'training.id', '=', 'teams_training.training_id')
            ->where('training.id', '=', $id)
            ->get();


        $data = [
            'players' => $players,
        ];

        return view('player.player_trainingPlayers', $data);
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
            ->select('players.id','players.name','age','position')
            ->join('teamplayers', 'players.id', '=', 'teamplayers.player_id')
            ->join('teams', 'teams.id', '=', 'teamplayers.team_id')
            ->where('teams.id', '=', $id)
            ->orderBy('name','desc ')
            ->get();


        $data = [
            'players' => $players,
        ];
        //var_dump($players); exit;

        return view('player.player_club_Info', $data);
    }

    public function myClubInfoPlayer($id)
    {



        $players = DB::table('players')
            ->select('players.name','age','position','email')
            ->where('players.id', '=', $id)
            ->get();

        //var_dump($players); exit;
        $data = [
            'players' => $players,
        ];


        return view('player.player_club_info_player', $data);
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

    // statistiky hracov v lige
    // zobrazi len ligy
    public function StatisticsOverview()
    {
        $league = DB::table('league')->get();
        $data = [
            'league' => $league,
        ];


        return view('player.player_statisticsOverview', $data);
    }

   /* public function statistics($id)
    {

        $statistics = DB::table('PlayerInGame')
            ->select('*')
            ->orderBy('PlayerInGame.goals', 'desc')
            ->join('players', 'players.id', '=', 'PlayerInGame.playerGameID')
            ->join('teamplayers', 'teamplayers.player_id', '=', 'players.id')
            ->join('teams_in_league', 'teams_in_league.team_id', '=', 'teamplayers.team_id')
            ->where('teams_in_league.league_id', '=', $id)
            ->get();

        //var_dump($statistics);exit;
        $data = [
            'statistics' => $statistics,
        ];

        return view('player.player_statistics', $data);

    }*/

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
            ->get();


        $data = [
            'statistics' => $statistics,
        ];

        return view('player.player_statistics_goal', $data);

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

        return view('player.player_statistics_asists', $data);

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

        return view('player.player_statistics_yellowC', $data);

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

        return view('player.player_statistics_redC', $data);

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

        return view('player.player_statistics_mins', $data);

    }


}





