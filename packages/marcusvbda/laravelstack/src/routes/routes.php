<?php
$prefix = config("laravelstack.router.prefix");
Route::group(['middleware' => 'web'], function () use ($prefix) {
    Route::group(['prefix' => ($prefix ? $prefix : null)], function () use ($prefix) {
        require 'auth.php';
        Route::group(['middleware' => ['laravelstack_auth', 'verified']], function () {
            Route::get('', 'marcusvbda\laravelstack\Http\Controllers\HomeController@index')->name("laravelstack.home");
        });
    });
});
