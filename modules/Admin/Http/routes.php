<?php

Route::group(['middleware' => 'web', 'prefix' => 'admin', 'namespace' => 'Modules\Admin\Http\Controllers'], function()
{
	Route::get('/', [
		'as' => 'admin::dashboard',
		'uses' => 'AdminController@index'
	]);

    Route::group([
        'prefix' => 'images',
    ], function(){

        Route::group(['prefix' => 'job'], function(){
            Route::get('/', 'ImageController@jobList');
        });
        Route::group(['prefix' => 'headgear'], function(){
            Route::get('/', 'ImageController@headgearList');
        });
    });
});