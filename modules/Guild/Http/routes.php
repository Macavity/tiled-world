<?php

Route::group(['middleware' => 'web', 'prefix' => 'guild', 'namespace' => 'Modules\Guild\Http\Controllers'], function()
{
	Route::get('/', 'GuildController@index');
});