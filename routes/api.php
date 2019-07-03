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

        Route::middleware('api.role:super-admin')->get('/user', function (Request $request) {
            $user = \App\Models\User::first();
            $user->revoke();
        });

        Route::namespace('Auth')->middleware("api.token")->group(function () {
           Route::patch('user/patch',"UserAPI@patch");

        });


        Route::namespace('WePlan')->middleware("api.token")->group(function () {
            Route::apiResource('activities','WeActivitiesAPI');
            Route::post('/activities/get/{date?}/{filter?}','WeActivitiesAPI@get')->name("activities.get");
            Route::post('/activities/enroll','WeActivitiesAPI@enroll')->name("activities.enroll");
            Route::post('/activities/confirm','WeActivitiesAPI@confirm')->name("activities.confirm");
            Route::post('/activities/decline','WeActivitiesAPI@decline')->name("activities.decline");

            Route::get('/teams/{id}/players',"WeTeamAPI@players")->name("teams.players");
            Route::apiResource('teams','WeTeamAPI');
            Route::get('/players/byteam',"WePlayerAPI@byTeam")->name("players.byteam");
            Route::apiResource('players','WePlayerAPI');

            Route::get('/calendar/{date?}','CalendarAPI@plan')->name("calendar.plan")->where(['date' => '[0-9]{4}-[0-1]{1}[0-9]{1}-[0-3]{1}[0-9]{1}']);





        });



            Route::namespace('BadmintonPeople')->prefix("BP")->name("badmintonpeople.")->middleware("api.token")->group(function () {
            Route::get("/players","BpPlayerAPI@index")->name("players.index");
            Route::post("/players/store","BpPlayerAPI@store")->name("players.store");
        });
    });
});


