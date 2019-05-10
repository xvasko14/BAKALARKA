<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

use Illuminate\Support\Facades\DB;

use App\Admin;
use App\Player;
use App\User;
use App\Manager;


class PagesController extends Controller
{
    public function index(){
    	return view('pages.index');
    }

    public function league(){
    	return view('league.about');
    }
    
    public function Gallery(){
    	return view('pages.gallery');
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


        return view('pages.mygames', $data);
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

//var_dump($data); exit;


        return view('pages.mygames_lineup', $data);
    }

    // aky ma klub dany hrac
    // ZRUSENE ZATIAL KVOLI TOMU ZE SA CHCME DOSTAT NA KLUB HANISKY
    //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    public function myClub()
    {



        $teams = DB::table('teams')
            ->select('teams.*')
            ->where('teams.id', '=', 27)
            /*->join('teammanagers', 'teams.id', '=', 'teammanagers.team_id')
            ->where('teammanagers.manager_id', '=', 27)*/
            ->get();

        // $teams = DB::table('teamplayers')->where('id', $id)->first();
        // preco toto tak???  spytaj as jura

        // musi natvrdo este dat tabulku teams do premenej
        $data = [
            'teams' => $teams,
        ];




        return view('pages.club', $data);
    }
    // ZRUSENE ZATIAL KVOLI TOMU ZE SA CHCME DOSTAT NA KLUB HANISKY
    //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

    //aky hraci su v klube atd
    public function myClubInfo()
    {


        if(request()->has('search')){
            $find = request('search');
            $pattern = ".*" . $find . ".*";
            $players = DB::table('players')
                ->select('players.id', 'players.name', 'date_of_birth', 'position')
                ->join('teamplayers', 'players.id', '=', 'teamplayers.player_id')
                ->join('teams', 'teams.id', '=', 'teamplayers.team_id')
                ->where('teams.id', '=', '27')// natvrdo urcene ID hanisky
                //->orderBy('name', 'desc ')
                ->where('players.name','REGEXP',$pattern);
                 $players = $players->paginate(10);
        }
        else {

            $players = DB::table('players')
                ->select('players.id', 'players.name', 'date_of_birth', 'position')
                ->join('teamplayers', 'players.id', '=', 'teamplayers.player_id')
                ->join('teams', 'teams.id', '=', 'teamplayers.team_id')
                ->where('teams.id', '=', '27')// natvrdo urcene ID hanisky
                ->orderBy('name', 'desc ')
                ->paginate(15);

        }

        /*$data = [
            'players' => $players,

        ];*/
        //var_dump($players); exit;

        return view('pages.club_Info', compact('players'));
    }

    // asi vymazat neviem ci to tak moze byt ci nie
    public function myClubInfoSearch()
    {


       /* if(request()->has('search')){
            $find = request('search');
            $pattern = ".*" . $find . ".*";
            $players = DB::table('players')->where('name','REGEXP',$pattern);
            $players = $players->get();
        }



        $data = [
            'players' => $players,
        ];
        //var_dump($players); exit;

        return view('pages.club_Info',$data);*/
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


        return view('pages.club_info_player', $data);
    }
}
