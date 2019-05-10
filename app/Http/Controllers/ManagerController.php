<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Auth;
use App\Sezona;
use Carbon\Carbon;

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
        // prechod z priecinku do player-home cez bodku
        return view('manager.manager_home')->with('status', 'Ste uspesne prihlaseny ako Manazer !');
    }

    // aky ma klub dany hrac
    // ZRUSENE ZATIAL KVOLI TOMU ZE SA CHCME DOSTAT NA KLUB HANISKY
    //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    public function myClub()
    {

        $user = Auth::user()->id;
        //var_dump($user); exit;



        $teams = DB::table('teams')
            ->select('teams.*')
            ->join('teammanagers', 'teams.id', '=', 'teammanagers.team_id')
            ->where('teammanagers.manager_id', '=', $user)
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
    // ZRUSENE ZATIAL KVOLI TOMU ZE SA CHCME DOSTAT NA KLUB HANISKY
    //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

    //aky hraci su v klube atd
    public function myClubInfo()
    {


        $user = Auth::user()->id;

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
                ->orderBy('players.name','desc ')
                ->where('players.name','REGEXP',$pattern);
            $players = $players->paginate(10);
        }
        else {

        $players = DB::table('players')
            ->select('players.id','players.name', 'date_of_birth','position')
            ->join('teamplayers', 'players.id', '=', 'teamplayers.player_id')
            ->join('teams', 'teams.id', '=', 'teamplayers.team_id')
            ->join('teammanagers', 'teammanagers.team_id', '=', 'teamplayers.team_id')
            ->where('teammanagers.manager_id', '=', $user)
            //->where('teams.id', '=', $id)
            ->orderBy('name','desc ')
            ->paginate(15);



        }

        /*$data = [
            'players' => $players,
        ];
        //var_dump($players); exit;*/

        return view('manager.manager_club_Info',  compact('players'));
    }

    public function myClubInfoPlayer($id)
    {



        $players = DB::table('players')
            ->select('players.name','date_of_birth','position','email', 'weight','height','date_of_birth','player_number')
            ->where('players.id', '=', $id)
            ->get();

        //$years = \Carbon::parse($dateOfBirth)->age;
        //var_dump($players); exit;
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
            $request->input('club') == NULL) {
            return redirect()->back()->with('status', 'Musia byť vyplnene všetky položky');
        }

        $datetime = $request->input('date') . ' ' . $request->input('time');
        $data = array(
            'starts' => date('Y-m-d H:i:s',strtotime($datetime)),
            'length' => $request->input('length'),
            'teamTraining_id' => $request->input('club'),
            'specialization' => $request->input('specialization'),



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

        //var_dump($id); exit;
        $playersInGame = DB::table('PlayerInGame');

        /*$data = array(
            'playerGameID' => $request->input('player'),
            //'gameID' => $id,
            'goals' => $request->input('goals'),
            'yellowCard' => $request->input('yellowCard'),
            'redCard' => $request->input('redCard'),
        );*/

        $data = array(
            array('playerGameID'=>$request->input('brankar'),'gameID'=>$id, 'goals' => $request->input('goals'), 'asists' => $request->input('asists'),'min' => $request->input('min'),'yellowCard' => $request->input('yellowCard'),'redCard' => $request->input('redCard'),'substitution' => $request->input('substitution'),'OnBench' => $request->input('OnBench')),
            array('playerGameID'=>$request->input('obranca1'),'gameID'=>$id, 'goals' => $request->input('goals1'),'asists' => $request->input('asists1'),'min' => $request->input('min1'),'yellowCard' => $request->input('yellowCard1'),'redCard' => $request->input('redCard1'),'substitution' => $request->input('substitution1'),'OnBench' => $request->input('OnBench1')),
            array('playerGameID'=>$request->input('obranca2'),'gameID'=>$id, 'goals' => $request->input('goals2'),'asists' => $request->input('asists2'),'min' => $request->input('min2'),'yellowCard' => $request->input('yellowCard2'),'redCard' => $request->input('redCard2'),'substitution' => $request->input('substitution2'),'OnBench' => $request->input('OnBench2')),
            array('playerGameID'=>$request->input('obranca3'),'gameID'=>$id, 'goals' => $request->input('goals3'),'asists' => $request->input('asists3'),'min' => $request->input('min3'),'yellowCard' => $request->input('yellowCard3'),'redCard' => $request->input('redCard3'),'substitution' => $request->input('substitution3'),'OnBench' => $request->input('OnBench3')),
            array('playerGameID'=>$request->input('obranca4'),'gameID'=>$id, 'goals' => $request->input('goals4'),'asists' => $request->input('asists4'),'min' => $request->input('min4'),'yellowCard' => $request->input('yellowCard4'),'redCard' => $request->input('redCard4'),'substitution' => $request->input('substitution4'),'OnBench' => $request->input('OnBench4')),
            array('playerGameID'=>$request->input('zaloznik1'),'gameID'=>$id, 'goals' => $request->input('goals5'),'asists' => $request->input('asists5'),'min' => $request->input('min5'),'yellowCard' => $request->input('yellowCard5'),'redCard' => $request->input('redCard5'),'substitution' => $request->input('substitution5'),'OnBench' => $request->input('OnBench5')),
            array('playerGameID'=>$request->input('zaloznik2'),'gameID'=>$id, 'goals' => $request->input('goals6'),'asists' => $request->input('asists6'),'min' => $request->input('min6'),'yellowCard' => $request->input('yellowCard6'),'redCard' => $request->input('redCard6'),'substitution' => $request->input('substitution6'),'OnBench' => $request->input('OnBench6')),
            array('playerGameID'=>$request->input('zaloznik3'),'gameID'=>$id, 'goals' => $request->input('goals7'),'asists' => $request->input('asists7'),'min' => $request->input('min7'),'yellowCard' => $request->input('yellowCard7'),'redCard' => $request->input('redCard7'),'substitution' => $request->input('substitution7'),'OnBench' => $request->input('OnBench7')),
            array('playerGameID'=>$request->input('utocnik1'),'gameID'=>$id, 'goals' => $request->input('goals8'),'asists' => $request->input('asists8'),'min' => $request->input('min8'),'yellowCard' => $request->input('yellowCard8'),'redCard' => $request->input('redCard8'),'substitution' => $request->input('substitution8'),'OnBench' => $request->input('OnBench8')),
            array('playerGameID'=>$request->input('utocnik2'),'gameID'=>$id, 'goals' => $request->input('goals9'),'asists' => $request->input('asists9'),'min' => $request->input('min9'),'yellowCard' => $request->input('yellowCard9'),'redCard' => $request->input('redCard9'),'substitution' => $request->input('substitution9'),'OnBench' => $request->input('OnBench9')),
            array('playerGameID'=>$request->input('utocnik3'),'gameID'=>$id, 'goals' => $request->input('goals10'),'asists' => $request->input('asists10'),'min' => $request->input('min10'),'yellowCard' => $request->input('yellowCard10'),'redCard' => $request->input('redCard10'),'substitution' => $request->input('substitution10'),'OnBench' => $request->input('OnBench10')),
            array('playerGameID'=>$request->input('nahradnik1'),'gameID'=>$id, 'goals' => $request->input('goals11'),'asists' => $request->input('asists11'),'min' => $request->input('min11'),'yellowCard' => $request->input('yellowCard11'),'redCard' => $request->input('redCard11'),'substitution' => $request->input('substitution11'),'OnBench' => $request->input('OnBench11')),
            array('playerGameID'=>$request->input('nahradnik2'),'gameID'=>$id, 'goals' => $request->input('goals12'),'asists' => $request->input('asists12'),'min' => $request->input('min12'),'yellowCard' => $request->input('yellowCard12'),'redCard' => $request->input('redCard12'),'substitution' => $request->input('substitution12'),'OnBench' => $request->input('OnBench12')),
            array('playerGameID'=>$request->input('nahradnik3'),'gameID'=>$id, 'goals' => $request->input('goals13'),'asists' => $request->input('asists13'),'min' => $request->input('min13'),'yellowCard' => $request->input('yellowCard13'),'redCard' => $request->input('redCard13'),'substitution' => $request->input('substitution13'),'OnBench' => $request->input('OnBench13')),
            array('playerGameID'=>$request->input('nahradnik4'),'gameID'=>$id, 'goals' => $request->input('goals14'),'asists' => $request->input('asists14'),'min' => $request->input('min14'),'yellowCard' => $request->input('yellowCard14'),'redCard' => $request->input('redCard14'),'substitution' => $request->input('substitution14'),'OnBench' => $request->input('OnBench14')),
            array('playerGameID'=>$request->input('nahradnik5'),'gameID'=>$id, 'goals' => $request->input('goals15'),'asists' => $request->input('asists15'),'min' => $request->input('min15'),'yellowCard' => $request->input('yellowCard15'),'redCard' => $request->input('redCard15'),'substitution' => $request->input('substitution15'),'OnBench' => $request->input('OnBench15')),
        );
        //var_dump($data); exit;
        $playersInGame->insert($data);

        return redirect()->intended('admin');
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


        $data = array(
            'InjuryPlayerID' => $request->input('player'),
            'type_injury' => $request->input('type_injury'),
            'approximately_time' => $request->input('approximately_time'),
            'injury_status' => 0,
        );
        //var_dump($data);exit;

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
        else {

            $players = DB::table('injuries')
                ->select(DB::raw('injuries.*, players.name'))
                ->join('players', 'players.id', '=', 'injuries.InjuryPlayerID')
                ->join('teamplayers', 'teamplayers.player_id', '=', 'players.id')
                ->join('teammanagers', 'teammanagers.team_id', '=', 'teamplayers.team_id')
                ->where('teammanagers.manager_id', '=', $user)
                ->paginate(10);
        }

        // musi natvrdo este dat tabulku teams do premenej
       /* $data = [
            'players' => $players,
        ];*/

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
                ->where('name','REGEXP',$pattern);
                 $players = $players->paginate(10); }

        else {

                $players = DB::table('fine')
                    ->select(DB::raw('fine.*, players.name'))
                    ->join('players', 'players.id', '=', 'fine.FinePlayerID')
                    ->join('teamplayers', 'teamplayers.player_id', '=', 'players.id')
                    ->join('teammanagers', 'teammanagers.team_id', '=', 'teamplayers.team_id')
                    ->where('teammanagers.manager_id', '=', $user)
                    ->paginate(10);

            }

        // musi natvrdo este dat tabulku teams do premenej
       /* $data = [
            'players' => $players,
        ];*/

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
            ->get();


        $data = [
            'statistics' => $statistics,
        ];

        return view('manager.manager_statistics', $data);

    }

    public function statistics_asists()
    {

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
            ->get();


        $data = [
            'statistics' => $statistics,
        ];

        return view('manager.manager_statistics_asists', $data);

    }

    public function statistics_yellowC()
    {

        $statistics = DB::table('players')
            ->select( DB::raw('players.id, players.name, players.date_of_birth, players.position, SUM(PlayerInGame.yellowCard) as yellowCard'))
            ->join('PlayerInGame', 'players.id', '=', 'PlayerInGame.playerGameID')
            ->join('teamplayers', 'teamplayers.player_id', '=', 'players.id')
            ->join('teams_in_league', 'teams_in_league.team_id', '=', 'teamplayers.team_id')
            // ->where('teams_in_league.league_id', '=', $id)
            ->groupBy('players.id')
            ->groupBy('players.name')
            ->groupBy('players.date_of_birth')
            ->groupBy('players.position')
            ->orderBy('yellowCard','desc ')
            ->get();


        $data = [
            'statistics' => $statistics,
        ];

        return view('manager.manager_statistics_yellowC', $data);

    }
    public function statistics_redC()
    {

        $statistics = DB::table('players')
            ->select( DB::raw('players.id, players.name, players.date_of_birth, players.position, SUM(PlayerInGame.redCard) as redCard'))
            ->join('PlayerInGame', 'players.id', '=', 'PlayerInGame.playerGameID')
            ->join('teamplayers', 'teamplayers.player_id', '=', 'players.id')
            ->join('teams_in_league', 'teams_in_league.team_id', '=', 'teamplayers.team_id')
            // ->where('teams_in_league.league_id', '=', $id)
            ->groupBy('players.id')
            ->groupBy('players.name')
            ->groupBy('players.date_of_birth')
            ->groupBy('players.position')
            ->orderBy('redCard','desc ')
            ->get();


        $data = [
            'statistics' => $statistics,
        ];

        return view('manager.manager_statistics_redC', $data);

    }
    public function statistics_min()
    {

        $statistics = DB::table('players')
            ->select( DB::raw('players.id, players.name, players.date_of_birth, players.position, SUM(PlayerInGame.min) as min'))
            ->join('PlayerInGame', 'players.id', '=', 'PlayerInGame.playerGameID')
            ->join('teamplayers', 'teamplayers.player_id', '=', 'players.id')
            ->join('teams_in_league', 'teams_in_league.team_id', '=', 'teamplayers.team_id')
            // ->where('teams_in_league.league_id', '=', $id)
            ->groupBy('players.id')
            ->groupBy('players.name')
            ->groupBy('players.date_of_birth')
            ->groupBy('players.position')
            ->orderBy('min','desc ')
            ->get();


        $data = [
            'statistics' => $statistics,
        ];

        return view('manager.manager_statistics_mins', $data);

    }


}


