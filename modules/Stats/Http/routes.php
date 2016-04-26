<?php

Route::group(['middleware' => 'web', 'prefix' => 'stats', 'namespace' => 'Modules\Stats\Http\Controllers'], function()
{
	Route::get('/', 'StatsController@index');
});