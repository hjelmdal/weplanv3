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


// Redirects

Route::get('/nova/login','RedirectController@login')->middleware('guest');

Route::get('/slack', function() {
    $user = \App\Models\User::first();
   \Illuminate\Support\Facades\Notification::send($user,new \App\Notifications\NewUserRegistered($user));
});



