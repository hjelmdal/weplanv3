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

Route::get('/','HomeController@welcome')->name("index");

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/test', 'HomeController@test')->name('test');



// Facebook and Google Login

Route::name('facebook-redirect-create')->get('login/facebook/create', 'Auth\LoginController@redirectToFacebookCreate');
Route::name('facebook-redirect-login')->get('login/facebook', 'Auth\LoginController@redirectToFacebookLogin');
Route::get('login/facebook/callback', 'Auth\LoginController@handleFacebookCallback');

Route::name('google-redirect-create')->get('login/google/create', 'Auth\LoginController@redirectToGoogleCreate');
Route::name('google-redirect-login')->get('login/google', 'Auth\LoginController@redirectToGoogleLogin');
Route::get('login/google/callback', 'Auth\LoginController@handleGoogleCallback');

// LOGIN ROUTES

Route::middleware(['auth'])->prefix('user')->name("user.")->group(function () {
    Route::get('/','UserController@index')->middleware("verified")->name("index");
    Route::get('/profile','UserController@index')->name("profile");
});

Route::get("/user/pending","UserController@index")->middleware("auth")->name("verification.notice");

Route::get("/activities","WePlan\ActivitiesController@index")->middleware("auth")->name("activities.index");
Route::get("/activities/admin/{date?}","WePlan\ActivitiesController@admin")->middleware("auth")->name("activities.admin")->where(['date' => '[0-9]{4}-[0-1]{1}[0-9]{1}-[0-3]{1}[0-9]{1}']);
Route::get("/activities/{id}","WePlan\ActivitiesController@show")->middleware("auth")->name("activities.show")->where('id', '[0-9]+');
Route::get("/activities/create","WePlan\ActivitiesController@create")->middleware("auth")->name("activities.create");
Route::post("/activities/create","WePlan\ActivitiesController@store")->middleware("auth")->name("activities.store");
Route::get("/activities/plan/{date?}","WePlan\ActivitiesController@plan")->middleware("auth")->name("activities.plan")->where(['date' => '[0-9]{4}-[0-1]{1}[0-9]{1}-[0-3]{1}[0-9]{1}']);


Route::middleware(['auth'])->prefix('players')->name("players.")->group(function () {
    Route::get("/", "WePlan\PlayerController@index")->name("index");
    Route::get("/import", "WePlan\PlayerController@import")->name("import");

});


Route::middleware(['auth'])->prefix('teams')->name("teams.")->group(function () {
    Route::get("/","WePlan\TeamController@index")->middleware("auth")->name("index");

});

Route::middleware(['auth'])->namespace('WePlan')->group(function () {
    Route::resource('teams', 'TeamController');
});

// Redirects

//Route::get('/nova/login','RedirectController@login')->middleware('guest');





