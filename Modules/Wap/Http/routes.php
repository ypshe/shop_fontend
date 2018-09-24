<?php
Route::group(['middleware' => 'web', 'prefix' => 'wap', 'namespace' => 'Modules\Wap\Http\Controllers'], function () {
    Route::post('/loginHandle', 'LoginController@loginHandle');
    Route::get('/login', 'LoginController@index');
    Route::get('/register', 'RegisterController@index');
    Route::post('/registerHandle', 'RegisterController@register');
});

Route::group(['middleware' => ['web', 'checkAgent'], 'prefix' => 'wap', 'namespace' => 'Modules\Wap\Http\Controllers'], function () {
    Route::get('/{agent?}', 'WapController@index')->where('agent', 'A_[0-9]+');
    Route::get('/category', 'CategoryController@index');
    Route::get('/car', 'CarController@index');
    //搜索
    Route::group(['prefix' => 'search'], function () {
        Route::get('/', 'SearchController@index');
    });
    //商品请求接口
    Route::get('/getGood', 'GoodsController@getGood');
    Route::get('/goodDetail/{good_id}', 'GoodsController@goodDetail')->where('good_id', '[0-9]+');

    Route::group(['middleware' => 'authMobile'], function () {
        //用户操作
        Route::group(['prefix' => 'user'], function () {
            Route::get('/', 'UserController@index');
            Route::get('/edit', 'UserController@edit');
            Route::get('/set', 'UserController@set');
            Route::get('/collection', 'UserController@collection');
            Route::get('/coupon', 'UserController@coupon');
            Route::get('/address', 'UserController@address');
            Route::get('/selectAddress', 'UserController@selectAddress');
            Route::get('/addAddress/{id?}', 'UserController@addAddress')->where('id', '[0-9]+');
            Route::get('/addAddressByOrder', 'UserController@addAddress');
            Route::post('/addAddressHandle', 'UserController@addAddressHandle');
            Route::get('/accountSecurity', 'UserController@accountSecurity');
            Route::get('/changePhone', 'UserController@changePhone');
            Route::get('/changePassword', 'UserController@changePassword');
            Route::post('/editHandle', 'UserController@editHandle');
            Route::post('/changePassword', 'UserController@changePassword');
        });
        //订单操作
        Route::any('/orderConfirm', 'OrderController@confirm');
    });

});
//Route::group(['middleware' => ['web', 'authMobile'], 'prefix' => 'wap', 'namespace' => 'Modules\Wap\Http\Controllers'], function () {
