<?php

Route::group(['middleware' => 'web', 'prefix' => 'marketplace', 'namespace' => 'Modules\Marketplace\Http\Controllers'], function()
{
	Route::get('/', 'MarketplaceController@index');
});