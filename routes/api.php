<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
});

Route::group(['prefix' => 'password'], function () {
    Route::post('create', 'PasswordResetController@create');
    Route::get('find/{token}', 'PasswordResetController@find');
    Route::post('reset', 'PasswordResetController@reset');
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::group(['prefix' => 'category'], function () {
        Route::post('add', 'CategoryController@add');
        Route::get('getall', 'CategoryController@getAll');
        Route::post('update', 'CategoryController@update');
        Route::post('remove/{id}', 'CategoryController@remove');
    });
    Route::group(['prefix' => 'brand'], function () {
        Route::post('add', 'BrandController@add');
        Route::get('getall', 'BrandController@getAll');
        Route::post('update', 'BrandController@update');
        Route::post('remove/{id}', 'BrandController@remove');
    });
    Route::group(['prefix' => 'goods'], function () {
        Route::post('add', 'GoodsController@add');
        Route::get('getall', 'GoodsController@getAll');
        Route::post('update', 'GoodsController@update');
        Route::post('remove/{id}', 'GoodsController@remove');
    });
});
