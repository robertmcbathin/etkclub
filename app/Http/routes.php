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

Route::get('/', function () {
    return view('index');
});
Route::get('/index', function () {
    return view('index');
});
Route::post('/signup', ['uses' => 'UserController@postSignUp', 'as' => 'signup']);
Route::get('/eula', ['uses' => 'UserController@showEula', 'as' => 'eula']);
Route::get('/privacy', ['uses' => 'UserController@showPrivacyPolitics', 'as' => 'privacy']);
Route::get('/entrance', function(){
	return view('entrance');
});
Route::get('/verify_account/{token}/activate', [
	'uses' => 'UserController@verifyAccount', 
	'as' => 'verify'
]);
Route::get('/entrance/ok/{email}', ['uses' => 'UserController@showEntranceOk', 'as' => 'entrance.ok']);
Route::get('/activation/ok', ['uses' => 'UserController@showActivationOk', 'as' => 'activation.ok']);