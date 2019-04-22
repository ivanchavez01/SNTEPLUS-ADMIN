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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::group(['middleware' => ['auth:web']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get("benefits", 'Benefits@index');
    Route::get("benefits/{id}/edit", 'Benefits@edit');
    Route::get("benefits/{id}/delete", 'Benefits@delete');
    Route::get('benefits/create', 'Benefits@create');
    Route::post('benefits/save', 'Benefits@save');
    Route::post('benefits/update', 'Benefits@update');
    Route::resource('business', 'BusinessController');
    Route::get('fcm/sender', 'Api\FCMController@form');
});

Route::get("politicas-de-privacidad.html", function() {
    return view("website.politicas_de_privacidad");
});