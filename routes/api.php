<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::name('api.')->group(function () {
    Route::prefix('v1')->namespace('API')->name("v1.")->group(function () {

        // Login
        Route::post('/login','Auth\AuthController@postLogin');
        // Register
        Route::post('/register','Auth\AuthController@postRegister');
        // Protected with APIToken Middleware
        Route::middleware('api.token')->group(function () {
            Route::post('/test','TestAPI@test');
            // Logout
            Route::post('/logout','Auth\AuthController@postLogout');
        });



        Route::namespace('Auth')->middleware("api.token")->group(function () {
            Route::post('user/roles',"UserAPI@authRoles")->name("auth-roles");
            Route::get('user',"UserAPI@getMyUser")->name("my-user");
            Route::patch('user',"UserAPI@patch");
            Route::post('user',"UserAPI@saveAvatar");
            Route::post('user/associate',"UserAPI@associatePlayer");
            Route::post('user/dissociate',"UserAPI@dissociatePlayer");
            Route::post('user/activate',"UserAPI@activateEmail");
            Route::post('user/activate/resend',"UserAPI@sendNewActivationCode");
            Route::get("user/status","UserAPI@getUserStatus");
            Route::post('user/complete',"UserAPI@complete");
            //users
            Route::get("users","UserAPI@all");
            Route::get("users/filter/{filter}","UserAPI@filteredUsers");

        });


        Route::namespace('WePlan')->middleware("auth.complete")->group(function () {
            Route::apiResource('activities','WeActivitiesAPI');
            Route::post('/activities/get/{date?}/{filter?}','WeActivitiesAPI@get')->name("activities.get");
            Route::post('/activities/enroll','WeActivitiesAPI@enroll')->name("activities.enroll");
            Route::post('/activities/confirm','WeActivitiesAPI@confirm')->name("activities.confirm");
            Route::post('/activities/decline','WeActivitiesAPI@decline')->name("activities.decline");
            Route::get('declines/categories',"WeDeclineApi@categories")->name("declines.categories");

            Route::get('/teams/{id}/players',"WeTeamAPI@players")->name("teams.players");
            Route::apiResource('teams','WeTeamAPI');


            //Players
            Route::get("/players/find/{id}","WePlayerAPI@find")->name("players.find");
            Route::get('/players/byteam',"WePlayerAPI@byTeam")->name("players.byteam");
            Route::apiResource('players','WePlayerAPI')->middleware(["auth.complete"]);

            Route::get('/calendar/{date?}','CalendarAPI@plan')->name("calendar.plan")->where(['date' => '[0-9]{4}-[0-1]{1}[0-9]{1}-[0-3]{1}[0-9]{1}']);





        });



            Route::namespace('BadmintonPeople')->prefix("BP")->name("badmintonpeople.")->middleware("api.token")->group(function () {
            Route::get("/players","BpPlayerAPI@index")->name("players.index");
            Route::post("/players/store","BpPlayerAPI@store")->name("players.store");
            Route::post("/player/check", "BpPlayerAPI@checkPlayer")->name("player.check");
            Route::get("/players/{id}", "BpPlayerAPI@show")->name(("players.show"));
            Route::get("/players/find/{id}","BpPlayerAPI@find")->name("players.find");
        });
    });
});


