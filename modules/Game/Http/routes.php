<?php

Route::group(['middleware' => 'web', 'prefix' => 'game', 'namespace' => 'Modules\Game\Http\Controllers'], function()
{
	Route::get('/', 'GameController@index');
});