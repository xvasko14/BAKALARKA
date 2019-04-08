<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Auth;

use App\Admin;
use App\Player;
use App\User;
use App\Manager;

class GameController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:player');
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


        return view('player.player_mygames', $data);
    }




    public function FormationGames()
    {


        return view('player.player_mygames_formation');
    }


}
