<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// starostlivost o prihalsovanie
Auth::routes();



// starostlivost o stranky bez prihlasenia
Route::get('/','PagesController@index');

Route::get('/leagueOverview','LeagueController@LeagueOverview')->name('leagueOverview.main');
Route::prefix('leagueOverview')->group(function() {
Route::get('/league/{id}','LeagueController@main')->name('league.main');
});







Route::get('/services','PagesController@services');




Route::get('/home', 'HomeController@index')->name('home');

// not sure if it is working
Route::get('/logout', 'Auth\AdminLoginController@logout')->name('logout');

//ADMIN
//ADMIN
//ADMIN
Route::prefix('admin')->group(function() {
	Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login'); // name sme si urcili prezyvku toho controllera
	Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
	Route::get('/', 'AdminController@index')->name('admin.dashboard');
	//HRAC
	Route::get('/admin_update_player/{id}', 'AdminController@editPlayer')->name('admin.player.update');
    Route::post('/admin_update_player/{id}', 'AdminController@updatePlayer')->name('admin.player.updatePlayer');
	Route::get('/admin_list_player', 'AdminController@playersList')->name('admin.players.list');
	Route::get('/admin_insert_player', 'AdminController@newPlayer')->name('admin.player.insert');
    Route::post('/admin_insert_player', 'AdminController@insertPlayer')->name('admin.player.insertPlayer');

    //Manager
    Route::get('/admin_update_manager/{id}', 'AdminController@editManager')->name('admin.manager.update');
    Route::post('/admin_update_manager/{id}', 'AdminController@updateManager')->name('admin.manager.updateManager');
    Route::get('/admin_list_manager', 'AdminController@managersList')->name('admin.managers.list');
    Route::get('/admin_insert_manager', 'AdminController@newManager')->name('admin.manager.insert');
    Route::post('/admin_insert_manager', 'AdminController@insertManager')->name('admin.manager.insertManager');
    //Tim
    Route::get('/admin_update_team/{id}', 'AdminController@editTeam')->name('admin.team.update');
    Route::post('/admin_update_team/{id}', 'AdminController@updateTeam')->name('admin.team.updateTeam');
    Route::get('/admin_list_team', 'AdminController@teamsList')->name('admin.teams.list');///
    Route::get('/admin_insert_team','AdminController@newTeam')->name('admin.team.insert');
    Route::post('/admin_insert_team','AdminController@insertTeam')->name('admin.team.insertTeam');
    //Liga
    Route::get('/admin_list_league', 'AdminController@leagueList')->name('admin.league.list');///
    Route::get('/admin_insert_league','AdminController@newLeague')->name('admin.league.insert');
    Route::post('/admin_insert_league','AdminController@insertLeague')->name('admin.league.insertLeague');
    //games
    Route::get('/admin_insert_game','AdminController@newGame')->name('admin.game.insert');
    Route::post('/admin_insert_game','AdminController@insertGame')->name('admin.game.insertGame');

    //playerInGame-Zapas
    Route::get('/admin_insert_PlayerInGame_match','AdminController@GamesAdmin')->name('admin.PlayerInGame_match.insert');
    Route::get('/admin_insert_PlayerInGame_match/admin_insert_PlayerInGame_match_teams/{id}','AdminController@TeamsGameAdmin')->name('admin.TeamsGame');
    Route::get('/admin_insert_PlayerInGame_match/admin_insert_PlayerInGame_match_teams/admin_insert_PlayerInGame/{team},{id}','AdminController@newPlayerInGame')->name('admin.newPlayerInGame');
    Route::post('/admin_insert_PlayerInGame_match/admin_insert_PlayerInGame_match_teams/admin_insert_PlayerInGame/{id}','AdminController@insertPlayerInGame')->name('admin.PlayerInGame.insertGame');

    //playerInGame-tvorba strelcov a 11ky
    //Route::get('/admin_insert_PlayerInGame','AdminController@newPlayerInGame')->name('admin.PlayerInGame.insert');
    //Route::post('/admin_insert_PlayerInGame','AdminController@insertPlayerInGame')->name('admin.PlayerInGame.insertGame');
    //training
    Route::get('/admin_insert_training', 'AdminController@newTraining')->name('admin.training.insert');
    Route::post('/admin_insert_training', 'AdminController_a@insertTraining')->name('admin.training.insertTraining');




});




// PLAYER
// PLAYER
// PLAYER
Route::prefix('player_home')->group(function() {
	// !! VYSVETLENIE !!
	// preto davame iba /login lebo pri Player Login Controller volame funkciu showLoginFomr ktora sa odkazuje na dane view
	// !! VYSVETLENIE !!
	Route::get('/login', 'Auth\PlayerLoginController@showLoginForm')->name('player.login'); // name sme si urcili prezyvku toho controllera
	Route::post('/login', 'Auth\PlayerLoginController@login')->name('player.login.submit');
	Route::get('/', 'PlayerController@index')->name('player.dashboard');

    Route::get('/player_leagueOverview','PlayerController@LeagueOverview')->name('leagueOverview.main');
    Route::get('/player_leagueOverview/league/{id}','PlayerController@main')->name('player_league.main');


    Route::get('/player_club','PlayerController@myclub')->name('player_club.main');
    Route::get('/player_club/player_club_Info/{id}','PlayerController@myclubInfo')->name('player_club_Info.main');

    Route::get('/player_training','PlayerController@myTraining')->name('player_training.main');
    // bitie rovnakych url pozriet
    Route::get('/player_training/join/{id}','PlayerController@JoinMyTraining')->name('player_Join_training.main');
    Route::get('/player_training/remove/{id}','PlayerController@RemoveMyTraining')->name('player_Remove_training.main');

    //zobrazenie zapasov
    Route::get('/player_mygames','GameController@Games')->name('player_games.main');

    Route::get('/player_mygames_formation','GameController@FormationGames')->name('player_games_formation.main');









});




//MANAGER
//MANAGER
//MANAGER
Route::prefix('manager_home')->group(function() {
	// !! VYSVETLENIE !!
	// preto davame iba /login lebo pri Manager Login Controller volame funkciu showLoginFomr ktora sa odkazuje na dane view 
	// !! VYSVETLENIE !!
	Route::get('/login', 'Auth\ManagerLoginController@showLoginForm')->name('manager.login'); // name sme si urcili prezyvku toho controllera
	Route::post('/login', 'Auth\ManagerLoginController@login')->name('manager.login.submit');
	Route::get('/', 'ManagerController@index')->name('manager.dashboard');
    //liga
    Route::get('/manager_leagueOverview','ManagerController@LeagueOverview')->name('leagueOverview.main');
    Route::get('/manager_leagueOverview/league/{id}','ManagerController@main')->name('manager_league.main');

    //club
    Route::get('/manager_club','ManagerController@myclub')->name('manager_club.main');
    Route::get('/manager_club/manager_club_Info/{id}','ManagerController@myclubInfo')->name('manager_club_Info.main');

    //training
    Route::get('/manager_training','ManagerController@myTraining')->name('manager_training.main');
    Route::get('/manager_training/manager_trainingPlayers/{id}','ManagerController@PlayerInTraining')->name('manager_trainingPlayers.main');


    Route::get('/manager_insert_training', 'ManagerController@newTraining')->name('manager.training.insert');
    Route::post('/manager_insert_training', 'ManagerController@insertTraining')->name('manager.training.insertTraining');

    //zobrazenie zapasov
    Route::get('/manager_mygames','ManagerController@Games')->name('manager_games.main');
    Route::get('/manager_mygames/manager_mygames_lineup/{id}','ManagerController@GamesLineup')->name('manager.TeamsGame');

    //zranenie
    Route::get('/manager_injury','ManagerController@Injury')->name('manager_injury.main');
    Route::post('/manager_injury','ManagerController@InjuryInsert')->name('manager_injury_insert.main');

    //pokuta
    Route::get('/manager_fine','ManagerController@Fine')->name('manager_fine.main');
    Route::post('/manager_fine','ManagerController@FineInsert')->name('manager_fine_insert.main');

    //statistiky hracov v lige
    Route::get('/manager_statisticsOverview','ManagerController@StatisticsOverview')->name('statisticsOverview.main');
    Route::get('/manager_statisticsOverview/statistics/{id}','ManagerController@statistics')->name('manager_statistics.main');


});


