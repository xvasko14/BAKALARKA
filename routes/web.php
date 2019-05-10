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


Route::get('/contact', 'ContactController@create')->name('contact.create');
Route::post('/contact', 'ContactController@store')->name('contact.store');



// starostlivost o stranky bez prihlasenia
Route::get('/','PagesController@index');
Route::get('/gallery','PagesController@Gallery');

//statistiky hracov v lige
Route::get('/statisticsOverview','LeagueController@StatisticsOverview')->name('statisticsOverview.main');
Route::prefix('statisticsOverview')->group(function() {
Route::get('statistics_goal','LeagueController@statistics_goal')->name('statistics_goal.main');
Route::get('statistics_asists','LeagueController@statistics_asists')->name('statistics_asists.main');
Route::get('statistics_yellowC','LeagueController@statistics_yellowC')->name('statistics_yellowC.main');
Route::get('statistics_redC','LeagueController@statistics_redC')->name('statistics_redC.main');
Route::get('statistics_min','LeagueController@statistics_min')->name('statistics_min.main');
});

//mojklub, zursene zatial aby nebolo preskokova obrazovka
//Route::get('/club','PagesController@myclub')->name('club.main');
Route::get('/club_Info','PagesController@myclubInfo')->name('club_Info.main');
//Route::get('/club_Info','PagesController@myclubInfoSearch')->name('club_Info.main.search');
Route::get('/club_Info{id}/club_info_player.blade.php','PagesController@myclubInfoPlayer')->name('club_InfoPlayer.main');

// Zapasy
Route::get('/mygames','PagesController@Games')->name('games.main');
Route::get('/mygames/mygames_lineup/{id}','PagesController@GamesLineup')->name('TeamsGame');

Route::get('/leagueOverview','LeagueController@LeagueOverview')->name('leagueOverview.main');
Route::prefix('leagueOverview')->group(function() {
Route::get('/league/{id}','LeagueController@main')->name('league.main');
});




Route::get('/home', 'HomeController@index')->name('home');

// not sure if it is working
Route::get('/logout', 'Auth\AdminLoginController@logout')->name('logout');

//ADMIN
//ADMIN
//ADMIN
Route::prefix('admin')->group(function() {
	Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login'); // name sme si urcili prezyvku toho controllera
	Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/login/forgot', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
	//HRAC
	Route::get('/admin_update_player/{id}', 'AdminController@editPlayer')->name('admin.player.update');
    Route::post('/admin_update_player/{id}', 'AdminController@updatePlayer')->name('admin.player.updatePlayer');
	Route::get('/admin_list_player', 'AdminController@playersList')->name('admin.players.list');
	Route::get('/admin_insert_player', 'AdminController@newPlayer')->name('admin.player.insert');
    Route::post('/admin_insert_player', 'AdminController@insertPlayer')->name('admin.player.insertPlayer');
    Route::get('/admin_delete_player/{id}', 'AdminController@tryDeletePlayer')->name('admin.player.delete');
    Route::post('/admin_delete_player/{id}', 'AdminController@deletePlayer')->name('admin.player.deletePlayer');

    //Manager
    Route::get('/admin_update_manager/{id}', 'AdminController@editManager')->name('admin.manager.update');
    Route::post('/admin_update_manager/{id}', 'AdminController@updateManager')->name('admin.manager.updateManager');
    Route::get('/admin_list_manager', 'AdminController@managersList')->name('admin.managers.list');
    Route::get('/admin_insert_manager', 'AdminController@newManager')->name('admin.manager.insert');
    Route::post('/admin_insert_manager', 'AdminController@insertManager')->name('admin.manager.insertManager');
    Route::get('/admin_delete_manager/{id}', 'AdminController@tryDeleteManager')->name('admin.manager.delete');
    Route::post('/admin_delete_manager/{id}', 'AdminController@deleteManager')->name('admin.manager.deleteManager');

    //Tim
    Route::get('/admin_update_team/{id}', 'AdminController@editTeam')->name('admin.team.update');
    Route::post('/admin_update_team/{id}', 'AdminController@updateTeam')->name('admin.team.updateTeam');
    Route::get('/admin_list_team', 'AdminController@teamsList')->name('admin.teams.list');///
    Route::get('/admin_insert_team','AdminController@newTeam')->name('admin.team.insert');
    Route::post('/admin_insert_team','AdminController@insertTeam')->name('admin.team.insertTeam');
    Route::get('/admin_delete_team/{id}', 'AdminController@tryDeleteTeam')->name('admin.team.delete');
    Route::post('/admin_delete_team/{id}', 'AdminController@deleteTeam')->name('admin.team.deleteTeam');

    //Liga
    Route::get('/admin_update_league/{id}', 'AdminController@editLeague')->name('admin.league.update');
    Route::post('/admin_update_league/{id}', 'AdminController@updateLeague')->name('admin.league.updateLeague');
    Route::get('/admin_list_league', 'AdminController@leagueList')->name('admin.league.list');///
    Route::get('/admin_insert_league','AdminController@newLeague')->name('admin.league.insert');
    Route::post('/admin_insert_league','AdminController@insertLeague')->name('admin.league.insertLeague');
    Route::get('/admin_delete_league/{id}', 'AdminController@tryDeleteLeague')->name('admin.league.delete');
    Route::post('/admin_delete_league/{id}', 'AdminController@deleteLeague')->name('admin.league.deleteLeague');

    //games
    Route::get('/admin_update_game/{id}', 'AdminController@editGame')->name('admin.game.update');
    Route::post('/admin_update_game/{id}', 'AdminController@updateGame')->name('admin.game.updateGame');
    Route::get('/admin_insert_game','AdminController@newGame')->name('admin.game.insert');
    Route::post('/admin_insert_game','AdminController@insertGame')->name('admin.game.insertGame');
    Route::get('/admin_list_games', 'AdminController@gameList')->name('admin.game.list');

    Route::get('/admin_delete_game{id}', 'AdminController@tryDeleteGame')->name('admin.game.delete');
    Route::post('/admin_delete_game/{id}', 'AdminController@deleteGame')->name('admin.game.deleteGame');

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
    Route::post('/admin_insert_training', 'AdminController@insertTraining')->name('admin.training.insertTraining');

    Route::get('/admin_list_training', 'AdminController@trainingList')->name('admin.training.list');

    Route::get('/admin_update_training/{id}', 'AdminController@editTraining')->name('admin.training.update');
    Route::post('/admin_update_training/{id}', 'AdminController@updateTraining')->name('admin.training.updateTraining');

    Route::get('/admin_delete_training{id}', 'AdminController@tryDeleteTraining')->name('admin.training.delete');
    Route::post('/admin_delete_training/{id}', 'AdminController@deleteTraining')->name('admin.training.deleteTraining');


    //pokuty

    Route::get('/admin_insert_fine','AdminController@newFine')->name('admin.fine.insert');
    Route::post('/admin_insert_fine','AdminController@insertFine')->name('admin.fine.insertFine');
    Route::get('/admin_list_fine', 'AdminController@fineLists')->name('admin.fine.list');

    Route::get('/admin_update_fine/{id}', 'AdminController@editFine')->name('admin.fine.update');
    Route::post('/admin_update_fine/{id}', 'AdminController@updateFine')->name('admin.fine.updateFine');

    Route::get('/admin_delete_fine{id}', 'AdminController@tryDeleteFine')->name('admin.fine.delete');
    Route::post('/admin_delete_fine/{id}', 'AdminController@deleteFine')->name('admin.fine.deleteFine');

    //zranenia
    Route::get('/admin_insert_injury','AdminController@newInjury')->name('admin.injury.insert');
    Route::post('/admin_insert_injury','AdminController@insertInjury')->name('admin.injury.insertInjury');
    Route::get('/admin_list_injury', 'AdminController@injuryLists')->name('admin.injury.list');

    Route::get('/admin_update_injury/{id}', 'AdminController@editInjury')->name('admin.injury.update');
    Route::post('/admin_update_injury/{id}', 'AdminController@updateInjury')->name('admin.injury.updateInjury');

    Route::get('/admin_delete_injury/{id}', 'AdminController@tryDeleteInjury')->name('admin.injury.delete');
    Route::post('/admin_delete_injury/{id}', 'AdminController@deleteInjury')->name('admin.injury.deleteInjury');

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

    //liga
    Route::get('/player_leagueOverview','PlayerController@LeagueOverview')->name('leagueOverview.main');
    Route::get('/player_leagueOverview/league/{id}','PlayerController@main')->name('player_league.main');

    //mojklub
    //Route::get('/player_club','PlayerController@myclub')->name('player_club.main');
   //Route::get('/player_club/player_club_Info/{id}','PlayerController@myclubInfo')->name('player_club_Info.main');
    Route::get('/player_club_Info','PlayerController@myclubInfo')->name('player_club_Info.main');
    Route::get('/player_club_Info{id}/player_club_info_player','PlayerController@myclubInfoPlayer')->name('player_club_InfoPlayer.main');

//trening
    Route::get('/player_training','PlayerController@myTraining')->name('player_training.main');
    Route::get('/player_training/player_trainingPlayers/{id}','PlayerController@PlayerInTraining')->name('player_trainingPlayers.main');
    // bitie rovnakych url pozriet
    Route::get('/player_training/join/{id}','PlayerController@JoinMyTraining')->name('player_Join_training.main');
    Route::get('/player_training/remove/{id}','PlayerController@RemoveMyTraining')->name('player_Remove_training.main');

    //zobrazenie zapasov
    Route::get('/player_mygames','GameController@Games')->name('player_games.main');
    Route::get('/player_mygames/player_mygames_lineup/{id}','GameController@GamesLineup')->name('player.TeamsGame');

    Route::get('/player_mygames_formation','GameController@FormationGames')->name('player_games_formation.main');

    //statistiky hracov v lige
    Route::get('/player_statisticsOverview','PlayerController@StatisticsOverview')->name('statisticsOverview.main');
    Route::get('/player_statisticsOverview/statistics_goal','PlayerController@statistics_goal')->name('player_statistics.main');
    Route::get('/player_statisticsOverview/statistics_asists','PlayerController@statistics_asists')->name('player_statistics_asists.main');
    Route::get('/player_statisticsOverview/statistics_yellowC','PlayerController@statistics_yellowC')->name('player_statistics_yellowC.main');
    Route::get('/player_statisticsOverview/statistics_redC','PlayerController@statistics_redC')->name('player_statistics_redC.main');
    Route::get('/player_statisticsOverview/statistics_mins','PlayerController@statistics_min')->name('player_statistics_min.main');









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
    //Route::get('/manager_club','ManagerController@myclub')->name('manager_club.main');
    Route::get('/manager_club_Info','ManagerController@myclubInfo')->name('manager_club_Info.main');
    Route::get('/manager_club_Info{id}/manager_club_info_player.blade.php','ManagerController@myclubInfoPlayer')->name('manager_club_InfoPlayer.main');


    //training
    Route::get('/manager_trainingguide','ManagerController@TrainingGuide')->name('manager_trainingguide.main');
    Route::get('/manager_training','ManagerController@myTraining')->name('manager_training.main');
    Route::get('/manager_training/manager_trainingPlayers/{id}','ManagerController@PlayerInTraining')->name('manager_trainingPlayers.main');
    Route::get('/manager_training/manager_trainingPlayers/insert/{id}','ManagerController@TrainingStatusIn')->name('manager_training.in');
    Route::get('/manager_training/manager_trainingPlayers/delete/{id}','ManagerController@TrainingStatusDelete')->name('manager_training.delete');


    Route::get('/manager_insert_training', 'ManagerController@newTraining')->name('manager.training.insert');
    Route::post('/manager_insert_training', 'ManagerController@insertTraining')->name('manager.training.insertTraining');

    //zobrazenie zapasov
    Route::get('/manager_mygames','ManagerController@Games')->name('manager_games.main');
    Route::get('/manager_mygames/manager_mygames_lineup/{id}','ManagerController@GamesLineup')->name('manager.TeamsGame.formation');

    Route::get('/manager_insert_PlayerInGame_match/manager_insert_PlayerInGame_match_teams/{id}','ManagerController@TeamsGameManager')->name('manager.TeamsGame');
    Route::get('/manager_insert_PlayerInGame_match/manager_insert_PlayerInGame_match_teams/manager_insert_PlayerInGame/{team},{id}','ManagerController@newPlayerInGame')->name('manager.newPlayerInGame');
    Route::post('/manager_insert_PlayerInGame_match/manager_insert_PlayerInGame_match_teams/manager_insert_PlayerInGame/{id}','ManagerController@insertPlayerInGame')->name('manager.PlayerInGame.insertGame');
    //zranenie
    Route::get('/manager_injuryguide','ManagerController@InjuryGuide')->name('manager_injuryguide.main');
    Route::get('/manager_injury','ManagerController@Injury')->name('manager_injury.main');
    Route::post('/manager_injury','ManagerController@InjuryInsert')->name('manager_injury_insert.main');

    // TODO este nedorobeny pristup k tejto stranke
    Route::get('/manager_injuryplayers','ManagerController@InjuryPlayers')->name('manager_injuryplayers.main');
    Route::get('/manager_injuryplayers/insert/{id}','ManagerController@InjuryStatusIn')->name('manager_injury.in');
    Route::get('/manager_injuryplayers/delete/{id}','ManagerController@InjuryStatusDelete')->name('manager_injury.delete');
    //pokuta
    Route::get('/manager_fineguide','ManagerController@FIneGuide')->name('manager_fineguide.main');
    Route::get('/manager_fine','ManagerController@Fine')->name('manager_fine.main');
    Route::post('/manager_fine','ManagerController@FineInsert')->name('manager_fine_insert.main');

    // TODO este nedorobeny pristup k tejto stranke
    Route::get('/manager_fineplayers','ManagerController@FinePlayers')->name('manager_fineplayers.main');
    Route::get('/manager_fineplayers/insert/{id}','ManagerController@FineStatusIn')->name('manager_fine.in');
    Route::get('/manager_fineplayers/delete/{id}','ManagerController@FineStatusDelete')->name('manager_fine.delete');

    //statistiky hracov v lige
    Route::get('/manager_statisticsOverview','ManagerController@StatisticsOverview')->name('statisticsOverview.main');
    Route::get('/manager_statisticsOverview/statistics','ManagerController@statistics')->name('manager_statistics.main');
    Route::get('/manager_statisticsOverview/statistics_asists','ManagerController@statistics_asists')->name('manager_statistics_asists.main');
    Route::get('/manager_statisticsOverview/statistics_yellowC','ManagerController@statistics_yellowC')->name('manager_statistics_yellowC.main');
    Route::get('/manager_statisticsOverview/statistics_redC','ManagerController@statistics_redC')->name('manager_statistics_redC.main');
    Route::get('/manager_statisticsOverview/statistics_min','ManagerController@statistics_min')->name('manager_statistics_min.main');


    //Route::get('/manager_statisticsOverview/statistics/{id}','ManagerController@statistics')->name('manager_statistics.main');


});


