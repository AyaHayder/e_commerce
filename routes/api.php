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

Route::group(['prefix'=>'v1','namespace'=>'\Api\V1'],function () {


    Route::post('/user/login','UserController@login');
    Route::post('/user/register','UserController@register');
    Route::group(['middleware'=>'jwt.token'],function (){
        Route::get('orders','UserController@getOrders');
    });
});
