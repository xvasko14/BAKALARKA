<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Admin;
use App\Player;
use App\User;
use App\Manager;


class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */



    public function __construct()
    {
        // use only admin guard not user
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.admin_dashboard'); // upravime pre novy dashboard
    }







    /// PLAYER ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /// PLAYER ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /// PLAYER ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    public function newPlayer()
    {
        $teams = DB::table('teams')->get();
        $data = [
            'teams' => $teams,
        ];
        return view('admin.admin_insert_player', $data);
    }



    public function insertPlayer(Request $request)
    {
        if ($request->input('name') == NULL || $request->input('email') == NULL ||
            $request->input('password') == NULL || $request->input('password2') == NULL ||
            $request->input('age') == NULL || $request->input('height') == NULL ||
            $request->input('weight') == NULL ||
            $request->input('position') == NULL || $request->input('player_number') == NULL ||
            $request->input('club') == NULL) {
            return redirect()->back()->with('status', 'Musia byť vyplnene všetky položky');
        }

        $players = DB::table('players')->where('email', $request->input('email'))->first();
        if (!is_null($players)) {
            return redirect()->back()->with('status', 'E-mail už je v databázi');
        }
        if (strcmp($request->input('password'), $request->input('password2'))) {
            return redirect()->back()->with('status', 'Heslá sa nezhodujú');
        }


        $data = array(
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => \Hash::make($request->input('password')),
            'date_of_birth' => $request->input('age'),
            'position' => $request->input('position'),
            'height' => $request->input('height'),
            'weight' => $request->input('weight'),
            'player_number' => $request->input('player_number')
            //'club' => $request->input('club'),

        );
        // PRIRADOVANIE HRACOV TIMOM
        $playerId = DB::table('players')->insertGetId($data);

        $clubId = $request->input('club');

        $data = array(
            'player_id' => $playerId,
            'team_id' => $clubId,
        );
        DB::table('teamplayers')->insert($data);



        return redirect()->intended('admin/admin_list_player')->with('insert', 'Hráč pridaný !');
    }

    public function updatePlayer(Request $request, $id)
    {
        if ($request->input('name') == NULL || $request->input('email') == NULL ||
            $request->input('height') == NULL ||
            $request->input('weight') == NULL ||
            $request->input('age') == NULL ||
            $request->input('position') == NULL ||
            $request->input('player_number') == NULL ||
            $request->input('club') == NULL) {
            return redirect()->back()->with('status', 'Musia byť vyplnene všetky položky');
        }


        $players = DB::table('players')->where('id', $id)->update(['name' => $request->input('name')]);
        $players = DB::table('players')->where('id', $id)->update(['email' => $request->input('email')]);

        $players = DB::table('players')->where('id', $id)->update(['position' => $request->input('position')]);
        $players = DB::table('players')->where('id', $id)->update(['weight' => $request->input('weight')]);
        $players = DB::table('players')->where('id', $id)->update(['height' => $request->input('height')]);
        $players = DB::table('players')->where('id', $id)->update(['player_number' => $request->input('player_number')]);




        // zmenaj jeho klubu 
        $clubId = $request->input('club');

        $data = array(
            'player_id' => $id,
            'team_id' => $clubId,
        );

        $teamPlayers = DB::table('teamplayers')->where('player_id', $id)->first();

        if ($teamPlayers) {
            DB::table('teamplayers')->where('id', $teamPlayers->id)->update($data);
        } else {
            DB::table('teamplayers')->insert($data);
        }

        return redirect()->intended('admin/admin_list_player')->with('updated', 'Hráč pridaný!');

    }


    public function editPlayer($id)
    {   ///admin.player.update'
        $teams = DB::table('teams')->get();
        $players = DB::table('players')->where('id', $id)->first();
        $data = ['teams' => $teams,
            'players' => $players
        ];


        return view('admin.admin_update_player', $data);
    }

    public function playersList()
    {



        if(request()->has('search')){
            $find = request('search');
            $pattern = ".*" . $find . ".*";
            $players = DB::table('players')
                ->select('players.id','players.name')
                ->where('players.name','REGEXP',$pattern);
            $players = $players->paginate(10);
        }
        else {

            $players = DB::table('players');
            $players = $players->paginate(20)->appends([
                'name' => request('name'),
            ]);

        }




        return view('admin.admin_list_player', compact('players'));
    }

    // mazanie hracov
    public function tryDeletePlayer($id){
        $teams = DB::table('teams')->get();
        $players = DB::table('players')->where('id', $id)->first();
        $data = ['teams' => $teams,
            'players' => $players
        ];


        return view('admin.admin_delete_player', $data);
    }


    public function deletePlayer($id){
        DB::table('players')->where('id',$id)->delete();
        DB::table('teamplayers')->where('player_id',$id)->delete();
        return redirect()->intended('admin/admin_list_player')->with('updated', 'Hráč bol zmazaný!');
    }









    /// Manager //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /// Manager //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /// Manager //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /// Manager //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function newManager()
    {
        $teams = DB::table('teams')->get();
        $data = [
            'teams' => $teams,
        ];


        return view('admin.admin_insert_manager', $data);
    }

    public function insertManager(Request $request)
    {
        if ($request->input('name') == NULL || $request->input('email') == NULL ||
            $request->input('password') == NULL || $request->input('password2') == NULL || $request->input('age') == NULL || $request->input('club') == NULL) {
            return redirect()->back()->with('status', 'Musia byť vyplnene všetky položky');
        }
        $managers = DB::table('managers')->where('email', $request->input('email'))->first();
        if (!is_null($managers)) {
            return redirect()->back()->with('status', 'E-mail už je v databázi');
        }
        if (strcmp($request->input('password'), $request->input('password2'))) {
            return redirect()->back()->with('status', 'Heslá sa nezhodujú');
        }


        $data = array(
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => \Hash::make($request->input('password')),
            'date_of_birth' => $request->input('age'),
            //'club' => $request->input('club'),   

        );

        // PRIRADOVANIE MANAZEROV TIMOM

        $managerId = DB::table('managers')->insertGetId($data);

        $clubId = $request->input('club');

        $data = array(
            'manager_id' => $managerId,
            'team_id' => $clubId,
        );

        DB::table('teammanagers')->insert($data);


        return redirect()->intended('admin/admin_list_manager')->with('insert', 'Manažer pridaný !');
    }

    public function updateManager(Request $request, $id)
    {

        if ($request->input('name') == NULL || $request->input('email') == NULL ||
             $request->input('club') == NULL) {
            return redirect()->back()->with('status', 'Musia byť vyplnene všetky položky');
        }


        $managers = DB::table('managers')->where('id', $id)->update(['name' => $request->input('name')]);

        $managers = DB::table('managers')->where('id', $id)->update(['email' => $request->input('email')]);



        // zmenaj jeho klubu
        $clubId = $request->input('club');

        $data = array(
            'manager_id' => $id,
            'team_id' => $clubId,
        );

        $teammanagers = DB::table('teammanagers')->where('manager_id', $id)->first();

        if ($teammanagers) {
            DB::table('teammanagers')->where('id', $teammanagers->id)->update($data);
        } else {
            DB::table('teammanagers')->insert($data);
        }

        return redirect()->intended('admin/admin_list_manager')->with('updated', 'Manažer aktualizovaný !');

    }


    public function editManager($id)
    {

        $teams = DB::table('teams')->get();
        $managers = DB::table('managers')->where('id', $id)->first();
        $data = ['teams' => $teams,
            'managers' => $managers
        ];
        return view('admin.admin_update_manager', $data);
    }

    public function managersList()
    {

        if(request()->has('search')){
            $find = request('search');
            $pattern = ".*" . $find . ".*";
            $managers = DB::table('managers')
                ->select('managers.id','managers.name')
                ->where('managers.name','REGEXP',$pattern);
            $managers = $managers->paginate(10);
        }
        else {

            $managers = DB::table('managers');
            // kolko zbrazime timov (paginate)
            $managers = $managers->paginate(10)->appends([
                'name' => request('name'),
            ]);

        }

        return view('admin.admin_list_manager', compact('managers'));
    }

    // mazanie trenerov
    public function tryDeleteManager($id){
        $teams = DB::table('teams')->get();
        $managers = DB::table('managers')->where('id', $id)->first();
        $data = ['teams' => $teams,
            'managers' => $managers
        ];

        return view('admin.admin_delete_manager', $data);
    }


    public function deleteManager($id){
        DB::table('managers')->where('id',$id)->delete();
        DB::table('teammanagers')->where('manager_id',$id)->delete();
        return redirect()->intended('admin/admin_list_manager')->with('updated', 'Manažer zmazaný!');
    }





    /// Team //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /// Team //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /// Team //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /// Team //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    public function newTeam()
    {
        $league = DB::table('league')->get();

        //zobrazenie lig
        $data = [
            'league' => $league,
        ];
        return view('admin.admin_insert_team', $data)->with('insert', 'Tím pridaný!');
    }


    public function insertTeam(Request $request)
    {///toto v funkcii Request $request
        $teams = DB::table('teams');
        if ($request->input('name') == NULL) {
            return redirect()->back()->with('status', 'Musia byť vyplnene všetky položky');
        }

        $managers = DB::table('teams')->where('name', $request->input('name'))->first();
        if (!is_null($managers)) {
            return redirect()->back()->with('status', 'Rovnaký tím už existuje');
        }

        $data = array(
            'name' => $request->input('name'),
        );

        // PRIRADOVANIE MANAZEROV TIMOM

        $teamId = DB::table('teams')->insertGetId($data);

        $leagueId = $request->input('league');

        $data = array(
            'team_id' => $teamId,
            'league_id' => $leagueId,
        );

        DB::table('teams_in_league')->insert($data);



        return redirect()->intended('admin/admin_list_team');///!!!!!!!!!!!!!!bolo admin.registration.list

    }


    public function updateTeam(Request $request, $id)
    {

        if ($request->input('name') == NULL) {
            return redirect()->back()->with('status', 'Musia byť vyplnene všetky položky');
        }


        $teams = DB::table('teams')->where('id', $id)->update(['name' => $request->input('name')]);

        // zmenaj jeho klubu
        $leagueId = $request->input('league');

        $data = array(
            'team_id' => $id,
            'league_id' => $leagueId,
        );

        $teams_in_league = DB::table('teams_in_league')->where('team_id', $id)->first();
        //var_dump($id); exit;

        if ($teams_in_league) {
            DB::table('teams_in_league')->where('id', $teams_in_league->id)->update($data);
        } else {
            DB::table('teams_in_league')->insert($data);
        }

        return redirect()->intended('admin/admin_list_team')->with('updated', 'Tím aktualizovaný');


    }


    public function editTeam($id)
    {
        $league = DB::table('league')->get();
        $teams = DB::table('teams')->where('id', $id)->first();


        $data = ['league' => $league,
            'teams' => $teams
        ];
        return view('admin.admin_update_team', $data);

        //return view('admin.admin_update_team', compact('teams'));
    }

    public function teamsList()
    {


        if (request()->has('search')) {
            $find = request('search');
            $pattern = ".*" . $find . ".*";
            $teams = DB::table('teams')
            ->select('teams.id', 'teams.name')
                ->where('teams.name', 'REGEXP', $pattern);
            $teams = $teams->paginate(10);
        } else {

            $teams = DB::table('teams');

            $teams = $teams->paginate(10)->appends([
                'name' => request('name'),
            ]);

        }


            return view('admin.admin_list_team', compact('teams'));


    }

    public function tryDeleteTeam($id){
        $league = DB::table('league')->get();
        $teams = DB::table('teams')->where('id', $id)->first();


        $data = ['league' => $league,
            'teams' => $teams
        ];

        return view('admin.admin_delete_team', $data);
    }


    public function deleteTeam($id){
        DB::table('teams')->where('id',$id)->delete();
        DB::table('teams_in_league')->where('team_id',$id)->delete();
        return redirect()->intended('admin/admin_list_team')->with('insert', 'Tím zmazany');
    }




    /// League //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /// League //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /// League //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /// League ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    public function newLeague()
    {
        $league = DB::table('league')->get();
        $sezona = DB::table('sezona')->get();
        $data = [
            'league' => $league,
            'sezona' => $sezona,
        ];
        return view('admin.admin_insert_league',$data )->with('insert', 'Liga zmazaná');
    }


    public function insertLeague(Request $request)
    {///toto v funkcii Request $request
        $league = DB::table('league');
        if ($request->input('name') == NULL || $request->input('teams_number') == NULL) {
            return redirect()->back()->with('status', 'Musia byť vyplnene všetky položky');
        }

        $managers = DB::table('league')->where('name', $request->input('name'))->first();
        if (!is_null($managers)) {
            return redirect()->back()->with('status', 'Rovnaká liga už existuje');
        }

        $data = array(
            'name' => $request->input('name'),
            'teams_number' => $request->input('teams_number'),
            'season'=> $request->input('season'),
        );


        DB::table('league')->insert($data);
        //  DB::table('show_infos')->insert($data2);

        return redirect()->intended('admin/admin_list_league');///!!!!!!!!!!!!!!bolo admin.registration.list
        //return $this->RegistrationlList($id);
    }

    public function editLeague($id)
    {
        $league = DB::table('league')->where('id', $id)->first();
        $sezona = DB::table('sezona')->get();


        $data = ['league' => $league,
            'sezona' => $sezona,
        ];
        return view('admin.admin_update_league', $data);

        //return view('admin.admin_update_team', compact('teams'));
    }

    public function updateLeague(Request $request, $id)
    {


        if ($request->input('name') == NULL || $request->input('teams_number') == NULL) {
            return redirect()->back()->with('status', 'Musia byť vyplnene všetky položky');
        }


        $league = DB::table('league')->where('id', $id)->update(['name' => $request->input('name')]);
        $league = DB::table('league')->where('id', $id)->update(['teams_number' => $request->input('teams_number')]);
        $league = DB::table('league')->where('id', $id)->update(['season' => $request->input('season')]);




        return redirect()->intended('admin/admin_list_league')->with('updated', 'Liga aktualizovaná');


    }
    public function leagueList()
    {

        if (request()->has('search')) {
            $find = request('search');
            $pattern = ".*" . $find . ".*";
            $league = DB::table('league')
                ->select('league.id', 'league.name', 'league.teams_number')
                ->where('league.name', 'REGEXP', $pattern);
            $league = $league->paginate(10);
        } else {

            $league = DB::table('league');

            // kolko zbrazime timov (paginate)
            $league = $league->paginate(10)->appends([
                'name' => request('name'),
                'teams_number' => request('teams_number'),
            ]);



        }



        return view('admin.admin_list_league', compact('league'));

    }

    public function tryDeleteLeague($id){
        $league = DB::table('league')->where('id', $id)->first();
        $sezona = DB::table('sezona')->get();


        $data = ['league' => $league,
            'sezona' => $sezona,

        ];

        return view('admin.admin_delete_league', $data);
    }


    public function deleteLeague($id){
        DB::table('league')->where('id',$id)->delete();
        DB::table('teams_in_league')->where('league_id',$id)->delete();
        return redirect()->intended('admin/admin_list_league')->with('deleted', 'Liga zmazaná');

    }

    /// Game //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function newGame()
    {
        $teams = DB::table('teams')->get();
        $players = DB::table('players')->get();
        $sezona = DB::table('sezona')->get();
        $data = [
            'teams' => $teams,
            'players' => $players,
            'sezona' => $sezona,
        ];

        return view('admin.admin_insert_game', $data);
    }

    public function insertGame(Request $request)
    {///toto v funkcii Request $request
        $game = DB::table('game');

        if ($request->input('Date') == NULL || $request->input('time') == NULL ||
            $request->input('Round') == NULL || $request->input('club1') == NULL || $request->input('club2') == NULL || $request->input('result1') == NULL || $request->input('result2') == NULL) {
            return redirect()->back()->with('status', 'Musia byť vyplnene všetky položky');
        }


        // hraju v tom istom kole
        $samegameround = DB::table('game')->where('Round', $request->input('Round'))
            ->where('team1', $request->input('club1'))
            ->first();

        // hraju v tom istom kole
        $samegameround2 = DB::table('game')->where('Round', $request->input('Round'))
            ->where('team2', $request->input('club2'))
            ->first();
        // rovnake timy co uz bolo
        $samegame = DB::table('game')
            ->where('team1', $request->input('club1'))
            ->where('team2', $request->input('club2'))
            ->first();
        //var_dump($samegame); exit;
        if (!is_null($samegameround)) {
            return redirect()->back()->with('status', ' Zápas v tomto ligovom kole už bol vytvorený');
        }
        if (!is_null($samegameround2)) {
            return redirect()->back()->with('status', ' Zápas v tomto ligovom kole už bol vytvorený');
        }
        if (!is_null($samegame)) {
            return redirect()->back()->with('status', ' Teito tímy už spolu hrali');
        }


        $datetime = $request->input('Date') . ' ' . $request->input('time');
        $data = array(
            'Date' => date('Y-m-d H:i:s',strtotime($datetime)),
            'Round'=> $request->input('Round'),
            'sezona'=> $request->input('sezona'),
            'team1' => $request->input('club1'),
            'team2' => $request->input('club2'),
            'team1_goals' => $request->input('result1'),
            'team2_goals' => $request->input('result2'),

           // 'brankar' => $request->input('club1'),

        );
        //var_dump($data);exit;

        $game->insert($data);


        return redirect()->intended('admin/admin_list_games');///!!!!!!!!!!!!!!bolo admin.registration.list
    }

    public function gameList()
    {
        $games = DB::table('game')->get();;

        foreach ($games as $game) {
            $game->teamName1 = DB::table('teams')->select('name')->where('id', '=', $game->team1)->first()->name;
            $game->teamName2 = DB::table('teams')->select('name')->where('id', '=', $game->team2)->first()->name;
        }

        // kolko zbrazime timov (paginate)
        $data = [
            'game' => $games,
        ];


        return view('admin.admin_list_games', $data);

    }
    public function updateGame(Request $request, $id)
    {
        if ($request->input('Round') == NULL || $request->input('club1') == NULL || $request->input('club2') == NULL || $request->input('result1') == NULL || $request->input('result2') == NULL) {
            return redirect()->back()->with('status', 'Musia byť vyplnene všetky položky');
        }



        $game = DB::table('game')->where('id', $id)->update(['team1' => $request->input('club1')]);
        $game = DB::table('game')->where('id', $id)->update(['team2' => $request->input('club2')]);
        $game = DB::table('game')->where('id', $id)->update(['team1_goals' => $request->input('result1')]);
        $game = DB::table('game')->where('id', $id)->update(['team2_goals' => $request->input('result2')]);
        $game = DB::table('game')->where('id', $id)->update(['sezona' => $request->input('sezona')]);
        $game = DB::table('game')->where('id', $id)->update(['Round' => $request->input('Round')]);




        return redirect()->intended('admin/admin_list_games');

    }

    public function editGame($id)
    {
        $teams = DB::table('teams')->get();
        $sezona = DB::table('sezona')->get();
        $game = DB::table('game')->where('id', $id)->first();


        $data = ['game' => $game,
            'teams' => $teams,
            'sezona' => $sezona,
        ];
        return view('admin.admin_update_game', $data);

        //return view('admin.admin_update_team', compact('teams'));
    }

    public function tryDeleteGame($id)
    {
        $teams = DB::table('teams')->get();
        $sezona = DB::table('sezona')->get();
        $game = DB::table('game')->where('id', $id)->first();


        $data = ['game' => $game,
            'teams' => $teams,
            'sezona' => $sezona,
        ];
        return view('admin.admin_delete_game', $data);

        //return view('admin.admin_update_team', compact('teams'));
    }

    public function deleteGame($id){
        DB::table('game')->where('id', $id)->delete();
        DB::table('PlayerInGame')->where('gameID',$id)->delete();

        return redirect()->intended('admin/admin_list_games');
    }


    /// PlayerInGame //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // nacitanie zapasov ake sa hrali
    public function GamesAdmin()
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


        return view('admin.admin_insert_PlayerInGame_match', $data);
    }


    // nacitanie klubov toho zapasu
    public function TeamsGameAdmin($id)
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

        return view('admin.admin_insert_PlayerInGame_match_teams', $data);
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

        return view('admin.admin_insert_PlayerInGame', $data);

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

        return redirect()->intended('admin');
    }


    /// Training //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function newTraining()
    {
        $teams = DB::table('teams')->get();
        $data = [
            'teams' => $teams,
        ];
        return view('admin.admin_insert_training', $data);
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

        if ($date) {
            return redirect()->back()->with('date', 'V tento datum uz je trening');
        }
        $data = array(
            'starts' => date('Y-m-d H:i:s',strtotime($datetime)),
            'length' => $request->input('length'),
            'teamTraining_id' => $request->input('club'),
            'specialization' => $request->input('specialization'),
            'content_of_training' => $request->input('content_of_training'),


        );

        //var_dump($data);exit;
        $training->insert($data);


        return redirect()->intended('admin/admin_list_training')->with('insert', 'Pridaný tréning');
    }

    public function trainingList()
    {

        $training = DB::table('training')->paginate(10);

        $data = [
            'training' => $training,
        ];

        return view('admin.admin_list_training', $data);
    }
    public function updateTraining(Request $request, $id)
    {
        $fine = DB::table('training')->where('id', $id)->update(['teamTraining_id' => $request->input('club')]);
        $fine = DB::table('training')->where('id', $id)->update(['specialization' => $request->input('specialization')]);
        $fine = DB::table('training')->where('id', $id)->update(['content_of_training' => $request->input('content_of_training')]);
        $fine = DB::table('training')->where('id', $id)->update(['length' => $request->input('length')]);





        return redirect()->intended('admin/admin_list_training')->with('updated', 'Paktualizovan7 tréning');


        //return view('admin.admin_update_team', compact('teams'));
    }

    public function editTraining($id)
    {
        $training = DB::table('training')->where('id', $id)->first();
        $teams = DB::table('teams')->get();;


        $data = ['training' => $training,
            'teams' => $teams,
        ];
        return view('admin.admin_update_training', $data);

        //return view('admin.admin_update_team', compact('teams'));
    }
    public function tryDeleteTraining($id)
    {
        $training = DB::table('training')->where('id', $id)->first();
        $teams = DB::table('teams')->get();;


        $data = ['training' => $training,
            'teams' => $teams,
        ];
        return view('admin.admin_delete_training', $data);

        //return view('admin.admin_update_team', compact('teams'));
    }

    public function deleteTraining($id){
        DB::table('training')->where('id', $id)->delete();
        DB::table('teams_training')->where('training_id',$id)->delete();

        return redirect()->intended('admin/admin_list_training')->with('deleted', 'Tréning odstranený');
    }

    // POKUTY
    public function newFine()
    {



        $players = DB::table('players')->get();


        $data = [
            'players' => $players,
        ];



        return view('admin.admin_insert_fine', $data);
    }

    public function insertFine(Request $request)
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


        return redirect()->intended('admin/admin_list_fine');///!!!!!!!!!!!!!!bolo admin.registration.list
        ///
    }

    public function fineLists()
    {

        if(request()->has('search')){
            $find = request('search');
            $pattern = ".*" . $find . ".*";
            $players = DB::table('fine')
                ->join('players', 'players.id', '=', 'fine.FinePlayerID')
                ->select('fine.id',
                    'fine.reason',
                    'fine.sum',
                    'players.name')
                ->where('players.name','REGEXP',$pattern);
            $players = $players->paginate(10);
        }
        else {

            $players = DB::table('fine')
                ->join('players', 'players.id', '=', 'fine.FinePlayerID')
                ->select('fine.id',
                    'fine.reason',
                    'fine.sum',
                    'players.name')
                ->paginate(10);

        }


        $data = [
            'players' => $players,
        ];

        return view('admin.admin_list_fine', $data);
    }

    public function editFine($id)
    {
        $fine = DB::table('fine')->where('id', $id)->first();
        $players = DB::table('players')->get();


        $data = ['fine' => $fine,
            'players' => $players,
        ];
        return view('admin.admin_update_fine', $data);

        //return view('admin.admin_update_team', compact('teams'));
    }

    public function updateFine(Request $request, $id)
    {


        $fine = DB::table('fine')->where('id', $id)->update(['FinePlayerID' => $request->input('player')]);
        $fine = DB::table('fine')->where('id', $id)->update(['reason' => $request->input('reason')]);
        $fine = DB::table('fine')->where('id', $id)->update(['sum' => $request->input('sum')]);





        return redirect()->intended('admin/admin_list_fine')->with('updated', 'Pokuta aktualizovaná');

    }

    public function tryDeleteFine($id)
    {
        $fine = DB::table('fine')->where('id', $id)->first();
        $players = DB::table('players')->get();;


        $data = ['fine' => $fine,
            'players' => $players,
        ];
        return view('admin.admin_delete_fine', $data);

        //return view('admin.admin_update_team', compact('teams'));
    }

    public function deleteFine($id){
        DB::table('fine')->where('id', $id)->delete();

        return redirect()->intended('admin/admin_list_fine')->with('deleted', 'Pokuta vymazaná');
    }

    // Zranenia
    public function newInjury()
    {

        $players = DB::table('players')->get();

        // musi natvrdo este dat tabulku teams do premenej
        $data = [
            'players' => $players,
        ];



        return view('admin.admin_insert_injury', $data);
    }

    public function insertInjury(Request $request)
    {

        if ($request->input('player') == NULL ||
            $request->input('type_injury') == NULL ||
            $request->input('approximately_time') == NULL ) {
            return redirect()->back()->with('status', 'Musia byť vyplnene všetky položky');
        }

        $injury = DB::table('injuries');


        $data = array(
            'InjuryPlayerID' => $request->input('player'),
            'type_injury' => $request->input('type_injury'),
            'approximately_time' => $request->input('approximately_time'),
            'injury_status' => 0,
        );
        //var_dump($data);exit;

        $injury->insert($data);


        return redirect()->intended('admin/admin_list_injury')->with('insert', 'Pridané zranenie');
        ///
    }

    public function injuryLists()
    {


        if(request()->has('search')){
            $find = request('search');
            $pattern = ".*" . $find . ".*";
            $players = DB::table('injuries')
                ->join('players', 'players.id', '=', 'injuries.InjuryPlayerID')
                ->select('injuries.id',
                    'injuries.type_injury',
                    'injuries.approximately_time',
                    'players.name')
                ->where('players.name','REGEXP',$pattern);
            $players = $players->paginate(10);
        }
        else {

            $players = DB::table('injuries')
                ->join('players', 'players.id', '=', 'injuries.InjuryPlayerID')
                ->select('injuries.id',
                    'injuries.type_injury',
                    'injuries.approximately_time',
                    'players.name')
                ->paginate(10);

        }


        // musi natvrdo este dat tabulku teams do premenej
        $data = [
            'players' => $players,
        ];

        return view('admin.admin_list_injury', $data);
    }

    public function editInjury($id)
    {
        $injuries = DB::table('injuries')->where('id', $id)->first();
        $players = DB::table('players')->get();


        $data = ['injuries' => $injuries,
            'players' => $players,
        ];
        return view('admin.admin_update_injury', $data);

        //return view('admin.admin_update_team', compact('teams'));
    }

    public function updateInjury(Request $request, $id)
    {


        $injuries = DB::table('injuries')->where('id', $id)->update(['InjuryPlayerID' => $request->input('player')]);
        $injuries = DB::table('injuries')->where('id', $id)->update(['type_injury' => $request->input('type_injury')]);
        $injuries = DB::table('injuries')->where('id', $id)->update(['approximately_time' => $request->input('approximately_time')]);





        return redirect()->intended('admin/admin_list_injury')->with('updated', 'Zranenie aktualizované');

    }

    public function tryDeleteInjury($id)
    {
        $injuries = DB::table('injuries')->where('id', $id)->first();
        $players = DB::table('players')->get();;


        $data = ['injuries' => $injuries,
            'players' => $players,
        ];
        return view('admin.admin_delete_injury', $data);

        //return view('admin.admin_update_team', compact('teams'));
    }

    public function deleteInjury($id){
        DB::table('injuries')->where('id', $id)->delete();

        return redirect()->intended('admin/admin_list_injury')->with('deleted', 'Zranenie odstranené');
    }
}
