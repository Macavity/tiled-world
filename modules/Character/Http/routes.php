<?php

Route::group(['middleware' => 'web', 'prefix' => 'char', 'namespace' => 'Modules\Character\Http\Controllers'], function()
{
	Route::get('/', 'CharacterController@index');
    Route::get('/edit', 'CharacterController@create');
    Route::get('/create', 'CharacterController@create');
	Route::post('/create', 'CharacterController@store');
    Route::delete('/edit/{char}', 'CharacterController@destroy');

	Route::get('/skills', 'CharacterController@skills');
	Route::get('/inventory', 'CharacterController@inventory');
	Route::get('/equipment', 'CharacterController@equipment');
	Route::get('/pl', 'CharacterController@pl');
	Route::get('/quest', 'CharacterController@quest');
	Route::get('/jobquest', 'CharacterController@jobquest');
});