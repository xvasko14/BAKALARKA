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


        // toto este nebude fungovat
        // ADMIN_ DASHBOARD MAM SPRAVENE AKO ADMIN !!! teda iba admin (find OUT) 
        return redirect()->intended('admin/admin_list_player');
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
        $players = DB::table('players')->where('id', $id)->update(['date_of_birth' => $request->input('age')]);
        $players = DB::table('players')->where('id', $id)->update(['position' => $request->input('position')]);
        $players = DB::table('players')->where('id', $id)->update(['weight' => $request->input('weight')]);
        $players = DB::table('players')->where('id', $id)->update(['height' => $request->input('height')]);
        $players = DB::table('players')->where('id', $id)->update(['player_number' => $request->input('player_number')]);


        //$playerId = DB::table('players')->update($players);

        // zmenaj jeho klubu 
        $clubId = $request->input('club');

        $data = array(
            'player_id' => $id,
            'team_id' => $clubId,
        );

        $teamPlayers = DB::table('teamplayers')->where('id', $id)->first();

        if ($teamPlayers) {
            DB::table('teamplayers')->where('id', $teamPlayers->id)->update($data);
        } else {
            DB::table('teamplayers')->insert($data);
        }

        return redirect()->intended('admin/admin_list_player');

    }

    // TUTO FUNKCIU UPRAVIT !!!!!!!!!!!!! //////// PRETO
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

        $players = DB::table('players');
        // kolko zbrazime timov (paginate)
        $players = $players->paginate(20)->appends([
            'name' => request('name'),
        ]);

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
        return redirect()->intended('admin/admin_list_player');
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
        // toto este nebude fungovat
        // ADMIN_ DASHBOARD MAM SPRAVENE AKO ADMIN !!! teda iba admin (find OUT) 
        return redirect()->intended('admin/admin_list_manager');
    }

    public function updateManager(Request $request, $id)
    {

        if ($request->input('name') == NULL || $request->input('email') == NULL ||
            $request->input('age') == NULL || $request->input('club') == NULL) {
            return redirect()->back()->with('status', 'Musia byť vyplnene všetky položky');
        }


        $managers = DB::table('managers')->where('id', $id)->update(['name' => $request->input('name')]);

        $managers = DB::table('managers')->where('id', $id)->update(['email' => $request->input('email')]);
        $managers = DB::table('managers')->where('id', $id)->update(['date_of_birth' => $request->input('age')]);


        // zmenaj jeho klubu
        $clubId = $request->input('club');

        $data = array(
            'manager_id' => $id,
            'team_id' => $clubId,
        );

        $teammanagers = DB::table('teamplayers')->where('id', $id)->first();

        if ($teammanagers) {
            DB::table('teammanagers')->where('id', $teammanagers->id)->update($data);
        } else {
            DB::table('teammanagers')->insert($data);
        }

        return redirect()->intended('admin/admin_list_manager');

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

        $managers = DB::table('managers');
        // kolko zbrazime timov (paginate)
        $managers = $managers->paginate(10)->appends([
            'name' => request('name'),
        ]);
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
        return redirect()->intended('admin/admin_list_manager');
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
        return view('admin.admin_insert_team', $data);
    }


    public function insertTeam(Request $request)
    {///toto v funkcii Request $request
        $teams = DB::table('teams');
        if ($request->input('name') == NULL) {
            return redirect()->back()->with('status', 'Musia byť vyplnene všetky položky');
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


        // toto este nebude fungovat
        // ADMIN_ DASHBOARD MAM SPRAVENE AKO ADMIN !!! teda iba admin (find OUT)
        //return redirect()->intended('admin');

        // tu moze byt problem kedze ta premena data  sa moze odkazovat na to ze tam dame data z predosleho


        //nesom si isty preco to tu nemusi ist
        //DB::table('teams')->insert($data);


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

        $teams_in_league = DB::table('teams_in_league')->where('id', $id)->first();

        if ($teams_in_league) {
            DB::table('teams_in_league')->where('id', $teams_in_league->id)->update($data);
        } else {
            DB::table('teams_in_league')->insert($data);
        }

        return redirect()->intended('admin/admin_list_team');


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
        $teams = DB::table('teams');

        // usporiadanie timov podal abecedy
        $teams = $teams->orderBy('name');


        // kolko zbrazime timov (paginate)
        $teams = $teams->paginate(20)->appends([
            'name' => request('name'),
        ]);

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
        return redirect()->intended('admin/admin_list_team');
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
        return view('admin.admin_insert_league',$data );
    }


    public function insertLeague(Request $request)
    {///toto v funkcii Request $request
        $league = DB::table('league');
        if ($request->input('name') == NULL || $request->input('teams_number') == NULL) {
            return redirect()->back()->with('status', 'Musia byť vyplnene všetky položky');
        }

        $data = array(
            'name' => $request->input('name'),
            'teams_number' => $request->input('teams_number'),
            'season'=> $request->input('season'),
        );

        // tu moze byt problem kedze ta premena data  sa moze odkazovat na to ze tam dame data z predosleho
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


        $league = DB::table('teams')->where('id', $id)->update(['name' => $request->input('name')]);
        $league = DB::table('teams')->where('id', $id)->update(['teams_number' => $request->input('teams_number')]);
        $league = DB::table('teams')->where('id', $id)->update(['season' => $request->input('season')]);




        return redirect()->intended('admin/admin_list_league');


    }
    public function leagueList()
    {
        $league = DB::table('league');


        // kolko zbrazime timov (paginate)
        $league = $league->paginate(10)->appends([
            'name' => request('name'),
            'teams_number' => request('teams_number'),
        ]);


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
        return redirect()->intended('admin/admin_list_league');

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


        return redirect()->intended('admin/admin_list_team');///!!!!!!!!!!!!!!bolo admin.registration.list
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


        // toto este nebude fungovat
        // ADMIN_ DASHBOARD MAM SPRAVENE AKO ADMIN !!! teda iba admin (find OUT)
        return redirect()->intended('admin/admin_list_player');
    }

    public function trainingList()
    {

        $training = DB::table('training')->get();
        // kolko zbrazime timov (paginate)
        /*$training = $training->paginate(20)->appends([
            'teamTraining_id' => request('teamTraining_id'),
            'starts' => request('starts'),
            'length' => request('length'),
        ]);*/
        $data = [
            'training' => $training,
        ];

        return view('admin.admin_list_training', $data);
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

        return redirect()->intended('admin/admin_list_training');
    }

    // POKUTY
    public function newFine()
    {



        $players = DB::table('players')->get();


        // musi natvrdo este dat tabulku teams do premenej
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



        $players = DB::table('fine')
            ->join('players', 'players.id', '=', 'fine.FinePlayerID')
            ->select('fine.id',
                'fine.reason',
                'fine.sum',
                'players.name')
            ->get();
        // musi natvrdo este dat tabulku teams do premenej
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





        return redirect()->intended('admin/admin_list_fine');

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

        return redirect()->intended('admin/admin_list_fine');
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


        return redirect()->intended('admin/admin_list_injury');
        ///
    }

    public function injuryLists()
    {


        $players = DB::table('injuries')
            ->join('players', 'players.id', '=', 'injuries.InjuryPlayerID')
            ->select('injuries.id',
                'injuries.type_injury',
                'injuries.approximately_time',
                'players.name')
            ->get();

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





        return redirect()->intended('admin/admin_list_injury');

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

        return redirect()->intended('admin/admin_list_injury');
    }
}
