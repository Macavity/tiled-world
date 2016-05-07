<?php

Route::group(['middleware' => ['web','auth'], 'prefix' => 'game', 'namespace' => 'Modules\Game\Http\Controllers'], function()
{
	Route::get('/', 'GameController@index');
});

Route::group(['middleware' => ['web','auth'], 'prefix' => 'admin', 'namespace' => 'Modules\Game\Http\Controllers'], function()
{
	Route::get('/game', 'AdminGameController@index');
});