<?php

Route::group(['middleware' => 'web', 'prefix' => 'char', 'namespace' => 'Modules\Character\Http\Controllers'], function()
{
	// List own Characters
	Route::get('/', 'CharacterController@index');
    // Create new Character process
    Route::post('/', 'CharacterController@store');
    // Delete a character
    Route::delete('/delete/{char}', 'CharacterController@destroy')
        ->where('char', '[0-9]+');

    // View a single character
    Route::get('/view/{char}', 'CharacterController@view')
        ->where('char', '[0-9]+');

    // Create new Character Form
    Route::get('/create', 'CharacterController@create');

    // Specific views for the active character
    Route::get('/pl', 'CharacterController@pl');
    Route::get('/quest', 'CharacterController@quest');
    Route::get('/jobquest', 'CharacterController@jobquest');


    // Detail views of a Character
	Route::get('/view/{char}/skills', 'CharacterController@skills')
        ->where('char', '[0-9]+');
	Route::get('/view/{char}/inventory', 'CharacterController@inventory')
        ->where('char', '[0-9]+');
	Route::get('/view/{char}/equipment', 'CharacterController@equipment')
        ->where('char', '[0-9]+');
});