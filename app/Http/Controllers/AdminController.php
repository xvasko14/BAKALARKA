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
            $request->input('password') == NULL || $request->input('password2') == NULL || $request->input('age') == NULL || $request->input('position') == NULL || $request->input('club') == NULL) {
            return redirect()->back()->with('status', 'Musia byť vyplnene všetky položky');
        }
        $players = DB::table('players')->where('email', $request->input('email'))->first();
        if (!is_null($players)) {
            return redirect()->back()->with('status', 'E-mail už je v databázi');
        }
        if (strcmp($request->input('password'), $request->input('password2'))) {
            return redirect()->back()->with('status', 'Heslá sa nezhodujú');
        }
        if ((!is_numeric($request->input('age')))) {
            return redirect()->back()->with('status', 'pozicia je  položka typu string');
        }

        $data = array(
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => \Hash::make($request->input('password')),
            'age' => $request->input('age'),
            'position' => $request->input('position'),
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
            $request->input('age') == NULL || $request->input('position') == NULL || $request->input('club') == NULL) {
            return redirect()->back()->with('status', 'Musia byť vyplnene všetky položky');
        }


        $players = DB::table('players')->where('id', $id)->update(['name' => $request->input('name')]);
        $players = DB::table('players')->where('id', $id)->update(['email' => $request->input('email')]);
        $players = DB::table('players')->where('id', $id)->update(['age' => $request->input('age')]);
        $players = DB::table('players')->where('id', $id)->update(['position' => $request->input('position')]);


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
        $players = $players->paginate(10)->appends([
            'name' => request('name'),
        ]);

        return view('admin.admin_list_player', compact('players'));
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
        if ((!is_numeric($request->input('age')))) {
            return redirect()->back()->with('status', 'pozicia je  položka typu string');
        }

        $data = array(
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => \Hash::make($request->input('password')),
            'age' => $request->input('age'),
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
        $managers = DB::table('managers')->where('id', $id)->update(['age' => $request->input('age')]);


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




    /// League //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /// League //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /// League //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /// League ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    public function newLeague()
    {
        $league = DB::table('league')->get();
        return view('admin.admin_insert_league', compact('league'));
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
        );

        // tu moze byt problem kedze ta premena data  sa moze odkazovat na to ze tam dame data z predosleho
        DB::table('league')->insert($data);
        //  DB::table('show_infos')->insert($data2);

        return redirect()->intended('admin/admin_list_league');///!!!!!!!!!!!!!!bolo admin.registration.list
        //return $this->RegistrationlList($id);
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

    /// Game //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function newGame()
    {
        $teams = DB::table('teams')->get();
        $data = [
            'teams' => $teams,
        ];

        return view('admin.admin_insert_game', $data);
    }

    public function insertGame(Request $request)
    {///toto v funkcii Request $request
        $game = DB::table('game');
        /*if ($request->input('') == NULL) {
            return redirect()->back()->with('status', 'Musia byť vyplnene všetky položky');
        }*/

        $data = array(
            'team1' => $request->input('club1'),
            'team2' => $request->input('club2'),
            'team1_goals' => $request->input('result1'),
            'team2_goals' => $request->input('result2'),
        );
        //var_dump($data);exit;

        $game->insert($data);





        return redirect()->intended('admin/admin_list_team');///!!!!!!!!!!!!!!bolo admin.registration.list


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


        // toto este nebude fungovat
        // ADMIN_ DASHBOARD MAM SPRAVENE AKO ADMIN !!! teda iba admin (find OUT)
        return redirect()->intended('admin/admin_list_player');
    }
}