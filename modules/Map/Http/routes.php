<?php

Route::group(['middleware' => 'web', 'prefix' => 'map', 'namespace' => 'Modules\Map\Http\Controllers'], function()
{
	Route::get('/', 'MapController@index');
});