<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', 'SessionController@create');
Route::get('/', 'PublicController@create');
Route::get('guests', 'PublicController@create');

Route::get('/notes/delete/{data}', 'PublicController@delete');
Route::get('/notes/edit/{data}', 'PublicController@update');
Route::patch('guests', 'PublicController@store');
Route::post('/guests', 'PublicController@post');

Route::get('/login', 'SessionController@create');
Route::get('logout', 'SessionController@destroy');
Route::post('login', 'SessionController@store');
Route::get('register', 'SessionController@register');
Route::post('register', 'SessionController@newUser');
Route::resource('sessions', 'SessionController');

Route::patch('notes/edit/{data}', 'PublicController@store');

Route::get('register/verify/{confirmationCode}', [
    'as' => 'confirmation_path',
    'uses' => 'RegistrationController@confirm'
]);