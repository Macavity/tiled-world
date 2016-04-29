<?php

Route::group(['middleware' => 'web', 'prefix' => 'char', 'namespace' => 'Modules\Character\Http\Controllers'], function()
{
	// List own Characters
	Route::get('/', 'CharacterController@index');
    // Create new Character process
    Route::post('/', 'CharacterController@store');
    // Delete a character
    Route::delete('/delete/{character}', 'CharacterController@destroy');

    // View a single character
    Route::get('/view/{character}', [
        'as' => 'character_view',
        'uses' => 'CharacterController@view'
    ]);

    Route::post('/update/{character}', [
        'as' => 'character_update',
        'uses' => 'CharacterController@update'
    ]);


    // Create new Character Form
    Route::get('/create', 'CharacterController@create');

    // Specific views for the active character
    Route::get('/pl', 'CharacterController@pl');
    Route::get('/quest', 'CharacterController@quest');
    Route::get('/jobquest', 'CharacterController@jobquest');


    // Detail views of a Character
	Route::get('/view/{character}/skills', 'CharacterController@skills');
	Route::get('/view/{character}/inventory', 'CharacterController@inventory');
	Route::get('/view/{character}/equipment', 'CharacterController@equipment');
});