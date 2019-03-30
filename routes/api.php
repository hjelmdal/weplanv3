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

Route::prefix('v1')->namespace('API')->group(function () {
    // Login
    Route::post('/login','Auth\AuthController@postLogin');
    // Register
    Route::post('/register','Auth\AuthController@postRegister');
    // Protected with APIToken Middleware
    Route::middleware('api.token')->group(function () {
        // Logout
        Route::post('/logout','Auth\AuthController@postLogout');
    });

    Route::middleware('api.role:super-admin')->get('/user', function (Request $request) {
        $user = \App\Models\User::first();
        $user->revoke();
    });


    Route::namespace('WePlan')->middleware("api.token")->group(function () {
        Route::apiResource('activities','WeActivitiesAPI');
    });
});


