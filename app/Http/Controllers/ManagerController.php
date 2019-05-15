<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Auth;
use App\Sezona;
use Carbon\Carbon;
use App\Finance;

use App\Admin;
use App\Player;
use App\User;
use App\Manager;
use Illuminate\Support\Facades\Input;
use Symfony\Component\Console\Question\Question;


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

        return view('manager.manager_home')->with('status', 'Ste uspesne prihlaseny ako Manazer !');
    }


    //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    public function myClub()
    {

        $user = Auth::user()->id;



        $teams = DB::table('teams')
            ->select('teams.*')
            ->join('teammanagers', 'teams.id', '=', 'teammanagers.team_id')
            ->where('teammanagers.manager_id', '=', $user)
            ->get();

        $data = [
            'teams' => $teams,
        ];



        //var_dump($teams); exit;
        return view('manager.manager_club', $data);
    }

    public function myClubInfo()
    {


        $user = Auth::user()->id;
        //var_dump($user); exit;

        if(request()->has('search')){
            $find = request('search');
            $pattern = ".*" . $find . ".*";
            $players = DB::table('players')
                ->select('players.id','players.name', 'date_of_birth','position')
                ->join('teamplayers', 'players.id', '=', 'teamplayers.player_id')
                ->join('teams', 'teams.id', '=', 'teamplayers.team_id')
                ->join('teammanagers', 'teammanagers.team_id', '=', 'teamplayers.team_id')
                ->where('teammanagers.manager_id', '=', $user)
                //->where('teams.id', '=', $id)
                ->orderBy('players.name','asc ')
                ->where('players.name','REGEXP',$pattern);
            $players = $players->paginate(10);
        }
        else if(request()->has('sort')){
            $players = DB::table('players')
                ->select('players.id','players.name', 'date_of_birth','position')
                ->join('teamplayers', 'players.id', '=', 'teamplayers.player_id')
                ->join('teams', 'teams.id', '=', 'teamplayers.team_id')
                ->join('teammanagers', 'teammanagers.team_id', '=', 'teamplayers.team_id')
                ->where('teammanagers.manager_id', '=', $user)
                ->orderBy('players.name',request('sort'))
                ->paginate(15);
                //->where('teams.id', '=', $id)
            //$players = $players->paginate(10);
            //$players = $players
        }
        else if(request()->has('sort_position')){
            $players = DB::table('players')
                ->select('players.id','players.name', 'date_of_birth','position')
                ->join('teamplayers', 'players.id', '=', 'teamplayers.player_id')
                ->join('teams', 'teams.id', '=', 'teamplayers.team_id')
                ->join('teammanagers', 'teammanagers.team_id', '=', 'teamplayers.team_id')
                ->where('teammanagers.manager_id', '=', $user)
                ->orderBy('players.position',request('sort_position'))
                ->paginate(15);
            //->where('teams.id', '=', $id)
            //$players = $players->paginate(10);
            //$players = $players
        }
        else if(request()->has('sort_age')){
            $players = DB::table('players')
                ->select('players.id','players.name', 'date_of_birth','position')
                ->join('teamplayers', 'players.id', '=', 'teamplayers.player_id')
                ->join('teams', 'teams.id', '=', 'teamplayers.team_id')
                ->join('teammanagers', 'teammanagers.team_id', '=', 'teamplayers.team_id')
                ->where('teammanagers.manager_id', '=', $user)
                ->orderBy('players.date_of_birth',request('sort_age'))
                ->paginate(15);
            //->where('teams.id', '=', $id)
            //$players = $players->paginate(10);
            //$players = $players
        }
        else {

        $players = DB::table('players')

            ->select('players.id','players.name', 'date_of_birth','position')
            ->join('teamplayers', 'players.id', '=', 'teamplayers.player_id')
            ->join('teams', 'teams.id', '=', 'teamplayers.team_id')
            ->join('teammanagers', 'teammanagers.team_id', '=', 'teamplayers.team_id')
            ->where('teammanagers.manager_id', '=', $user)
            //->where('teams.id', '=', $id)
            ->orderBy('name','asc ')
            ->paginate(15);



        }


        return view('manager.manager_club_Info',  compact('players'));
    }

    public function myClubInfoPlayer($id)
    {



        $players = DB::table('players')
            ->select('players.name','date_of_birth','position','email', 'weight','height','date_of_birth','player_number')
            ->where('players.id', '=', $id)
            ->get();

        $data = [
            'players' => $players,
        ];


        return view('manager.manager_club_info_player', $data);
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

        return view('manager.manager_league', $data);

    }

    /// Training //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function TrainingGuide()
    {
        return view('manager.manager_trainingguide');
    }

    public function newTraining()
    {

        $user = Auth::user()->id;
        //var_dump($user); exit;



        $teams = DB::table('teams')
            ->select('teams.*')
            ->join('teammanagers', 'teammanagers.team_id', '=', 'teams.id')
            ->where('teammanagers.manager_id', '=', $user)
            ->get();
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
            $request->input('specialization') == NULL ||
            $request->input('content_of_training') == NULL ||
            $request->input('club') == NULL) {
            return redirect()->back()->with('status', 'Musia byť vyplnene všetky položky');
        }

        $datetime = $request->input('date') . ' ' . $request->input('time');

        $date = DB::table('training')->where( DB::raw('starts'), $datetime)->first();
       // var_dump($date); exit;
        if ($date) {
            return redirect()->back()->with('date', 'V tento datum uz je trening');
        }

        $data = array(
            'starts' => date('Y-m-d H:i',strtotime($datetime)),
            'length' => $request->input('length'),
            'teamTraining_id' => $request->input('club'),
            'specialization' => $request->input('specialization'),
            'content_of_training' => $request->input('content_of_training'),



            //'club' => $request->input('club'),

        );

        //var_dump($data);exit;
        $training->insert($data);



        return redirect()->intended('manager_home')->with('training', 'Tréning bol uspešne vytvorený !');
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

        //return redirect()->back()->with('message', 'IT WORKS!');
        return view('manager.manager_training', $data);
    }

    // hraci ktory su na treningu
    public function PlayerInTraining($id)
    {
        if(request()->has('search')) {
            $find = request('search');
            $pattern = ".*" . $find . ".*";
            $players = DB::table('players')
                ->select(DB::raw('teams_training.*, players.name,date_of_birth, position'))
                ->join('teams_training', 'players.id', '=', 'teams_training.playerTraining_id')
                ->join('training', 'training.id', '=', 'teams_training.training_id')
                ->where('training.id', '=', $id)
                ->where('name','REGEXP',$pattern);
                $players = $players->paginate(10);

        }

        else {
        $players = DB::table('players')
            ->select(DB::raw('teams_training.*, players.name,date_of_birth, position'))
            ->join('teams_training', 'players.id', '=', 'teams_training.playerTraining_id')
            ->join('training', 'training.id', '=', 'teams_training.training_id')
            ->where('training.id', '=', $id)
            ->paginate(10);
        }

        $content_of_training = DB::table('training')
            ->select('content_of_training')
            ->where('id', '=', $id)
            ->first()->content_of_training;

        $data = [
            'players' => $players,
            'teamID'    => $id,
            'content_of_training'   => $content_of_training
        ];



        return view('manager.manager_trainingPlayers', $data);
    }

    public function TrainingStatusIn($id)
    {

        $data = array(
            'training_parcipitation' => 1,
        );
        //var_dump($data);exit;

        DB::table('teams_training')->where('id', $id)->update($data);
        //var_dump($data); exit;

        return redirect()->back();
    }

    public function TrainingStatusDelete($id)
    {


        $data = array(
            'training_parcipitation' => 0,
        );
        //var_dump($data);exit;

        DB::table('teams_training')->where('id', $id)->update($data);

        return redirect()->route('manager_training.main');
        ///
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
    ////////////////////////////////////////////
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
            ->where('PlayerInGame.OnBench', '=', '0')
            ->get();

        $teamRight = DB::table('players')
            ->select('*')
            ->join('PlayerInGame', 'players.id', '=', 'PlayerInGame.PlayerGameID')
            ->join('teamplayers', 'teamplayers.player_id', '=', 'PlayerInGame.PlayerGameID')
            ->where('gameID', '=', $id)
            ->where('teamplayers.team_id', '=', $game->team2)
            ->where('PlayerInGame.OnBench', '=', '0')
            ->get();

        $teamLeftSub = DB::table('players')
            ->select('*')
            ->join('PlayerInGame', 'players.id', '=', 'PlayerInGame.PlayerGameID')
            ->join('teamplayers', 'teamplayers.player_id', '=', 'PlayerInGame.PlayerGameID')
            ->where('gameID', '=', $id)
            ->where('teamplayers.team_id', '=', $game->team1)
            ->where('PlayerInGame.OnBench', '=', '1')
            ->get();

        $teamRightSub = DB::table('players')
            ->select('*')
            ->join('PlayerInGame', 'players.id', '=', 'PlayerInGame.PlayerGameID')
            ->join('teamplayers', 'teamplayers.player_id', '=', 'PlayerInGame.PlayerGameID')
            ->where('gameID', '=', $id)
            ->where('teamplayers.team_id', '=', $game->team2)
            ->where('PlayerInGame.OnBench', '=', '1')
            ->get();



        //var_dump($teamLeftSub);exit;

        $data = [
            'teamLeft' => $teamLeft,
            'teamRight' => $teamRight,
            'teamLeftSub' => $teamLeftSub,
            'teamRightSub' => $teamRightSub,

        ];


        return view('manager.manager_mygames_lineup', $data);
    }
    // nacitanie klubov toho zapasu
    public function TeamsGameManager($id)
    {

        $games = DB::table('game')
            ->select('*')
            ->where('game.id', '=', $id)
            ->get();

        foreach ($games as $game) {
            $game->teamName1 = DB::table('teams')->select('*')->where('id', '=', $game->team1)->first()->name;
            $game->teamName2 = DB::table('teams')->select('*')->where('id', '=', $game->team2)->first()->name;
        }

        $data = [
            'game' => $games,
        ];

        //var_dump($data); exit;

        return view('manager.manager_insert_PlayerInGame_match_teams', $data);
    }

    // nacitanie tej tabulky
    public function newPlayerInGame($team, $id)
    {
        //var_dump($team); exit;
        $players = DB::table('players')
            ->select('players.*')
            ->join('teamplayers', 'players.id', '=', 'teamplayers.player_id')
            ->join('teams', 'teams.id', '=', 'teamplayers.team_id')
            ->where('teams.id', '=', $team)
            ->get();

        $game = DB::table('game')
            ->select('game.*')
            ->where('game.id', '=', $id)
            ->first();

        $data = [
            'players' => $players,
            'game' => $game,
        ];
        //var_dump($data); exit;

        return view('manager.manager_insert_PlayerInGame', $data);

    }

    public function insertPlayerInGame(Request $request, $id)
    {

        $playersInGame = DB::table('PlayerInGame');

        $data = [];

        $rows = $request->input('row');

        $dataPlayers = [];

        foreach ($rows as $row) {
            if (in_array($row['hrac'], $dataPlayers)) {
                return redirect()->back()->with('status', 'Rovnaký hráč je vybraný viackrát');
            }

            $data[] = [
                'playerGameID'  => $row['hrac'],
                'gameID' => $id,
                'goals'  => $row['goals'],
                'asists'  => $row['asists'],
                'min'  => $row['min'],
                'redCard'  => $row['redCard'],
                'yellowCard'  => $row['yellowCard'],
                'substitution'  => $row['substitution'],
                'OnBench'  => $row['OnBench'],
            ];
            $dataPlayers[] = $row['hrac'];

        }

        $playersInGame->insert($data);

        return redirect()->intended('manager_home');
    }

    // ZRANENIA
    public function InjuryGuide()
    {
        return view('manager.manager_injuryguide');
    }


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

        if ($request->input('player') == NULL ||
            $request->input('type_injury') == NULL ||
            $request->input('approximately_time') == NULL) {
            return redirect()->back()->with('status', 'Musia byť vyplnene všetky položky');
        }





        $data = array(
            'InjuryPlayerID' => $request->input('player'),
            'type_injury' => $request->input('type_injury'),
            'approximately_time' => $request->input('approximately_time'),
            'injury_status' => 0,
        );
        //var_dump($data);exit;
        //var_dump($data ); exit;

        $injury->insert($data);


        return redirect()->intended('manager_home')->with('zranenie', 'Zraneny hrac bol pridany do databazy !');///!!!!!!!!!!!!!!bolo admin.registration.list
        ///
    }

    public function InjuryPlayers()
    {
        $user = Auth::user()->id;
        //var_dump($user); exit;

        if(request()->has('search')){
            $find = request('search');
            $pattern = ".*" . $find . ".*";
            $players = DB::table('injuries')
                    ->select(DB::raw('injuries.*, players.name'))
                    ->join('players', 'players.id', '=', 'injuries.InjuryPlayerID')
                    ->join('teamplayers', 'teamplayers.player_id', '=', 'players.id')
                    ->join('teammanagers', 'teammanagers.team_id', '=', 'teamplayers.team_id')
                    ->where('teammanagers.manager_id', '=', $user)
                    ->where('name','REGEXP',$pattern);
                    $players = $players->paginate(10);
        }

        else if(request()->has('sort')){
            $players = DB::table('injuries')
                ->select(DB::raw('injuries.*, players.name'))
                ->join('players', 'players.id', '=', 'injuries.InjuryPlayerID')
                ->join('teamplayers', 'teamplayers.player_id', '=', 'players.id')
                ->join('teammanagers', 'teammanagers.team_id', '=', 'teamplayers.team_id')
                ->where('teammanagers.manager_id', '=', $user)
                ->orderBy('players.name',request('sort'))
                ->paginate(15);
            //->where('teams.id', '=', $id)
            //$players = $players->paginate(10);
            //$players = $players
        }
        else if(request()->has('sort_type')){
            $players = DB::table('injuries')
                ->select(DB::raw('injuries.*, players.name'))
                ->join('players', 'players.id', '=', 'injuries.InjuryPlayerID')
                ->join('teamplayers', 'teamplayers.player_id', '=', 'players.id')
                ->join('teammanagers', 'teammanagers.team_id', '=', 'teamplayers.team_id')
                ->where('teammanagers.manager_id', '=', $user)
                ->orderBy('injuries.type_injury',request('sort_type'))
                ->paginate(15);
            //->where('teams.id', '=', $id)
            //$players = $players->paginate(10);
            //$players = $players
        }
        else if(request()->has('sort_time')){
            $players = DB::table('injuries')
                ->select(DB::raw('injuries.*, players.name'))
                ->join('players', 'players.id', '=', 'injuries.InjuryPlayerID')
                ->join('teamplayers', 'teamplayers.player_id', '=', 'players.id')
                ->join('teammanagers', 'teammanagers.team_id', '=', 'teamplayers.team_id')
                ->where('teammanagers.manager_id', '=', $user)
                ->orderBy('injuries.approximately_time',request('sort_time'))
                ->paginate(15);
            //->where('teams.id', '=', $id)
            //$players = $players->paginate(10);
            //$players = $players
        }
        else {

            $players = DB::table('injuries')
                ->select(DB::raw('injuries.*, players.name'))
                ->join('players', 'players.id', '=', 'injuries.InjuryPlayerID')
                ->join('teamplayers', 'teamplayers.player_id', '=', 'players.id')
                ->join('teammanagers', 'teammanagers.team_id', '=', 'teamplayers.team_id')
                ->where('teammanagers.manager_id', '=', $user)
                ->paginate(10);
        }



        return view('manager.manager_injuryplayers',  compact('players'));
    }

    public function InjuryStatusIn($id)
    {

        $data = array(
            'injury_status' => 1,
        );
        //var_dump($data);exit;

        DB::table('injuries')->where('id', $id)->update($data);

        return redirect()->route('manager_injuryplayers.main');
        ///
    }

    public function InjuryStatusDelete($id)
    {


        $data = array(
            'injury_status' => 0,
        );
        //var_dump($data);exit;

        DB::table('injuries')->where('id', $id)->update($data);

        return redirect()->route('manager_injuryplayers.main');
        ///
    }


    // POKUTY

    public function FineGuide()
    {
        return view('manager.manager_fineguide');
    }

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

        if ($request->input('player') == NULL ||
            $request->input('reason') == NULL ||
            $request->input('sum') == NULL ) {
            return redirect()->back()->with('status', 'Musia byť vyplnene všetky položky');
        }


        $fine = DB::table('fine');


        $data = array(
            'FinePlayerID' => $request->input('player'),
            'reason' => $request->input('reason'),
            'sum' => $request->input('sum'),
            'fine_pay' => 0,
        );
        //var_dump($data);exit;

        $fine->insert($data);


        return redirect()->intended('manager_home')->with('pokuta', 'Potrestny hrac bol pridany do databazy !');///!!!!!!!!!!!!!!bolo admin.registration.list
        ///
    }

    public function FinePlayers()
    {

        $user = Auth::user()->id;
        //var_dump($user); exit;
        if(request()->has('search')){
            $find = request('search');
            $pattern = ".*" . $find . ".*";
            $players = DB::table('fine')
                ->select(DB::raw('fine.*, players.name'))
                ->join('players', 'players.id', '=', 'fine.FinePlayerID')
                ->join('teamplayers', 'teamplayers.player_id', '=', 'players.id')
                ->join('teammanagers', 'teammanagers.team_id', '=', 'teamplayers.team_id')
                ->where('teammanagers.manager_id', '=', $user)
                ->where('players.name','REGEXP',$pattern);
                 $players = $players->paginate(10);
        }

        else if(request()->has('sort')){
            $players = DB::table('fine')
                ->select(DB::raw('fine.*, players.name'))
                ->join('players', 'players.id', '=', 'fine.FinePlayerID')
                ->join('teamplayers', 'teamplayers.player_id', '=', 'players.id')
                ->join('teammanagers', 'teammanagers.team_id', '=', 'teamplayers.team_id')
                ->where('teammanagers.manager_id', '=', $user)
                ->orderBy('players.name',request('sort'))
                ->paginate(15);
            //->where('teams.id', '=', $id)
            //$players = $players->paginate(10);
            //$players = $players
        }
        else if(request()->has('sort_reason')){
            $players = DB::table('fine')
                ->select(DB::raw('fine.*, players.name'))
                ->join('players', 'players.id', '=', 'fine.FinePlayerID')
                ->join('teamplayers', 'teamplayers.player_id', '=', 'players.id')
                ->join('teammanagers', 'teammanagers.team_id', '=', 'teamplayers.team_id')
                ->where('teammanagers.manager_id', '=', $user)
                ->orderBy('fine.reason',request('sort_reason'))
                ->paginate(15);
            //->where('teams.id', '=', $id)
            //$players = $players->paginate(10);
            //$players = $players
        }
        else if(request()->has('sort_sum')){
            $players = DB::table('fine')
                ->select(DB::raw('fine.*, players.name'))
                ->join('players', 'players.id', '=', 'fine.FinePlayerID')
                ->join('teamplayers', 'teamplayers.player_id', '=', 'players.id')
                ->join('teammanagers', 'teammanagers.team_id', '=', 'teamplayers.team_id')
                ->where('teammanagers.manager_id', '=', $user)
                ->orderBy('fine.sum',request('sort_sum'))
                ->paginate(15);
            //->where('teams.id', '=', $id)
            //$players = $players->paginate(10);
            //$players = $players
        }

        else {

                $players = DB::table('fine')
                    ->select(DB::raw('fine.*, players.name'))
                    ->join('players', 'players.id', '=', 'fine.FinePlayerID')
                    ->join('teamplayers', 'teamplayers.player_id', '=', 'players.id')
                    ->join('teammanagers', 'teammanagers.team_id', '=', 'teamplayers.team_id')
                    ->where('teammanagers.manager_id', '=', $user)
                    ->paginate(10);

            }



        return view('manager.manager_fineplayers', compact('players'));
    }

    public function FineStatusIn($id)
    {

        $data = array(
            'fine_pay' => 1,
        );
        //var_dump($data);exit;

        DB::table('fine')->where('id', $id)->update($data);

        return redirect()->route('manager_fineplayers.main');
        ///
    }

    public function FineStatusDelete($id)
    {


        $data = array(
            'fine_pay' => 0,
        );
        //var_dump($data);exit;

        DB::table('fine')->where('id', $id)->update($data);

        return redirect()->route('manager_fineplayers.main');
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

    public function statistics()
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

        return view('manager.manager_statistics', $data);

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

        return view('manager.manager_statistics_asists', $data);

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

        return view('manager.manager_statistics_yellowC', $data);

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

        return view('manager.manager_statistics_redC', $data);

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

        return view('manager.manager_statistics_mins', $data);

    }

    public function createM()
    {
        return view('manager.finance');
    }

    public function storeM(Request $request)
    {
       /* if ($request->input('Prijem') == NULL ||
            $request->input('Vydavokl') == NULL ||
            $request->input('Datum') == NULL ||
            $request->input('Nazov') == NULL ) {
            return redirect()->back()->with('status', 'Musia byť vyplnene všetky položky');
        }*/

        if ($request->input('Prijem') == NULL ||
            $request->input('Datum') == NULL ||
            $request->input('Vydavok') == NULL ||
            $request->input('Nazov') == NULL ) {
            return redirect()->back()->with('status', 'Musia byť vyplnene všetky položky');
        }

        $datum = DB::table('Finance')->where( DB::raw('Datum'), $request->input('Datum'))->first();
        // var_dump($date); exit;
        if ($datum) {
            return redirect()->back()->with('date', 'V tento datum uz je trening');
        }

        $stock = new Finance([

            'Prijem' => $request->get('Prijem'),
            'Vydavok' => $request->get('Vydavok'),
            'Datum' => $request->get('Datum'),
            'Nazov' => $request->get('Nazov')
        ]);
        $stock->save();


        //return view('manager.manager_home');
        return redirect()->intended('manager_home')->with('Financie', 'Financie klubu boli aktualizované !');
    }

    public function indexM()
    {
        return view('manager.finance_view');
    }

    public function lostM()
    {
        return view('manager.finance_lost');
    }


    public function chartM()
    {
        $result = DB::table('Finance as F')
            //->where('Nazov','=','Hello')
            ->orderBy('F.Datum', 'asc')
            ->get();
        //vardump($result); exit;
        return response()->json($result);
    }


}


