<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Auth;

use App\Admin;
use App\Player;
use App\User;
use App\Manager;

class ManagerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:manager');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // prechod z priecinku do player-home cez bodku
        return view('manager.manager_home');
    }

    // aky ma klub dany hrac
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
        return view('manager.manager_club', $data);
    }

    //aky hraci su v klube atd
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

        return view('manager.manager_club_Info', $data);
    }




    // zobrazi len ligy
    public function LeagueOverview()
    {
        $league = DB::table('league')->get();
        $data = [
            'league' => $league,
        ];


        return view('manager.manager_leagueOverview', $data);
    }


    // tabulka timov skore goly atd
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
            //var_dump($team->score );exit;
           /* $arr= array ($team->score);
            sort($arr);
            //var_dump($arr);*/

            //usort($myArray, function($a, $b) {
           //     return $a['score'] <=> $b['score'];
            //});



        }


        $data = [
            'teams' => $teams,
        ];

        return view('manager.manager_league', $data);

    }

    /// Training //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function newTraining()
    {
        $teams = DB::table('teams')->get();
        $data = [
            'teams' => $teams,
        ];
        return view('manager.manager_insert_training', $data);
    }


    public function insertTraining(Request $request)
    {

        $training = DB::table('training');
        if ($request->input('time') == NULL ||
            $request->input('date') == NULL ||
            $request->input('length') == NULL ||
            $request->input('club') == NULL) {
            return redirect()->back()->with('status', 'Musia byť vyplnene všetky položky');
        }

        $datetime = $request->input('date') . ' ' . $request->input('time');
        $data = array(
            'starts' => date('Y-m-d H:i:s',strtotime($datetime)),
            'length' => $request->input('length'),
            'teamTraining_id' => $request->input('club'),

            //'club' => $request->input('club'),

        );

        //var_dump($data);exit;
        $training->insert($data);



        return redirect()->intended('manager_home');
    }

    //ake treningy ma dany tim
    public function myTraining()
    {
        $user = Auth::user()->id;

        // nacitame timy usera
        $teams = DB::table('teams')
            ->select('teams.*')
            ->join('teammanagers', 'teams.id', '=', 'teammanagers.team_id')
            ->where('teammanagers.manager_id', '=', $user)
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


        $data = [
            'training' => $training,
            'teams_training' => $teamstraining
        ];


        return view('manager.manager_training', $data);
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

        return view('manager.manager_trainingPlayers', $data);
    }

    public function Games()
    {

        $games = DB::table('game')->get();

        //$database = DB::table('teams');

        foreach ($games as $game) {
            $game->teamName1 = DB::table('teams')->select('name')->where('id', '=', $game->team1)->first()->name;
            $game->teamName2 = DB::table('teams')->select('name')->where('id', '=', $game->team2)->first()->name;
        }

        $data = [
            'game' => $games,
        ];


        return view('manager.manager_mygames', $data);
    }

    // Supisky oboch timov v zapase
    public function GamesLineup($id)
    {

        $game = DB::table('game')
            ->select('*')
            ->where('id', '=', $id)
            ->first();

        $teamLeft = DB::table('players')
            ->select('*')
            ->join('PlayerInGame', 'players.id', '=', 'PlayerInGame.PlayerGameID')
            ->join('teamplayers', 'teamplayers.player_id', '=', 'PlayerInGame.PlayerGameID')
            ->where('gameID', '=', $id)
            ->where('teamplayers.team_id', '=', $game->team1)
            ->get();

        $teamRight = DB::table('players')
            ->select('*')
            ->join('PlayerInGame', 'players.id', '=', 'PlayerInGame.PlayerGameID')
            ->join('teamplayers', 'teamplayers.player_id', '=', 'PlayerInGame.PlayerGameID')
            ->where('gameID', '=', $id)
            ->where('teamplayers.team_id', '=', $game->team2)
            ->get();

       // var_dump($players);exit;

        $data = [
            'teamLeft' => $teamLeft,
            'teamRight' => $teamRight,
        ];

//var_dump($data); exit;


        return view('manager.manager_mygames_lineup', $data);
    }

    // ZRANENIA
    public function Injury()
    {

        $user = Auth::user()->id;
        //var_dump($user); exit;



        $players = DB::table('players')
            ->select('players.*')
            ->join('teamplayers', 'players.id', '=', 'teamplayers.player_id')
            ->join('teammanagers', 'teamplayers.team_id', '=', 'teammanagers.team_id')
            ->where('teammanagers.manager_id', '=', $user)
            ->get();

        // musi natvrdo este dat tabulku teams do premenej
        $data = [
            'players' => $players,
        ];



        return view('manager.manager_injury', $data);
    }


    public function InjuryInsert(Request $request)
    {


        $injury = DB::table('injuries');


        $data = array(
            'InjuryPlayerID' => $request->input('player'),
            'type_injury' => $request->input('type_injury'),
            'approximately_time' => $request->input('approximately_time'),
        );
        //var_dump($data);exit;

        $injury->insert($data);


        return redirect()->intended('manager_home/manager_injury');///!!!!!!!!!!!!!!bolo admin.registration.list
        ///
    }

    // POKUTY
    public function Fine()
    {

        $user = Auth::user()->id;
        //var_dump($user); exit;



        $players = DB::table('players')
            ->select('players.*')
            ->join('teamplayers', 'players.id', '=', 'teamplayers.player_id')
            ->join('teammanagers', 'teamplayers.team_id', '=', 'teammanagers.team_id')
            ->where('teammanagers.manager_id', '=', $user)
            ->get();


        // musi natvrdo este dat tabulku teams do premenej
        $data = [
            'players' => $players,
        ];



        return view('manager.manager_fine', $data);
    }


    public function FineInsert(Request $request)
    {


        $fine = DB::table('fine');


        $data = array(
            'FinePlayerID' => $request->input('player'),
            'reason' => $request->input('reason'),
            'sum' => $request->input('sum'),
        );
        //var_dump($data);exit;

        $fine->insert($data);


        return redirect()->intended('manager_home/manager_fine');///!!!!!!!!!!!!!!bolo admin.registration.list
        ///
    }

    // statistiky hracov v lige
    // zobrazi len ligy
    public function StatisticsOverview()
    {
        $league = DB::table('league')->get();
        $data = [
            'league' => $league,
        ];


        return view('manager.manager_statisticsOverview', $data);
    }

    public function statistics($id)
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

        return view('manager.manager_statistics', $data);

    }


}


