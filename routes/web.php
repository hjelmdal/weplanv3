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



Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::get('/','UserController@index')->middleware("verified")->name("index");
    Route::get('/profile','UserController@index')->name("profile");
});

Route::get("/user/pending","UserController@index")->middleware("auth")->name("verification.notice");
