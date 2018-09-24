<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'IndexController@index');
Route::get('/logout', 'IndexController@logout');

Route::post('/ajax/confirm/captcha', 'IndexController@checkCaptcha');

//请求接口
Route::group(['middleware' => ['web'], 'prefix' => 'api'], function () {
    Route::post('/getTopCate', 'ApiController@getTopCate');
    Route::group(['middleware' => ['auth']], function () {
        Route::post('/getCar', 'ApiController@getCar');
        Route::post('/collectGood', 'ApiController@collectGood');
        Route::post('/goToBuy', 'ApiController@goToBuy');
        Route::post('/addBuyCar', 'ApiController@addBuyCar');
        Route::post('/getUserAddress', 'ApiController@getUserAddress');
        Route::post('/getCollection', 'ApiController@getCollection');
        Route::post('/delCollection', 'ApiController@delCollection');
        Route::post('/getCart', 'ApiController@getCart');
        Route::post('/checkout', 'ApiController@checkout');
        Route::post('/getToken', 'ApiController@getToken');
    });
});

