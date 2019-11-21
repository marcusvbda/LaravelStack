<?php
Route::group(['prefix' => "auth"], function () use ($prefix) {
    Route::group(['prefix' => "login"], function () use ($prefix) {
        Route::get('', 'marcusvbda\laravelstack\Http\Controllers\AuthController@login')->name("laravelstack.login");
        Route::post('', 'marcusvbda\laravelstack\Http\Controllers\AuthController@signin')->name("laravelstack.signin");
    });
    Route::group(['prefix' => "forget_my_password"], function () use ($prefix) {
        Route::get('', 'marcusvbda\laravelstack\Http\Controllers\AuthController@forgetMyPassword')->name("laravelstack.forgetMyPassword");
        Route::post('reset_password', 'marcusvbda\laravelstack\Http\Controllers\AuthController@resetPassword')->name("laravelstack.resetPassword");
        Route::get('{token}/renew_password', 'marcusvbda\laravelstack\Http\Controllers\AuthController@renewPassword')->name("laravelstack.renewPassword");
        Route::post('{token}/set_password', 'marcusvbda\laravelstack\Http\Controllers\AuthController@setPassword')->name("laravelstack.setPassword");
    });
    Route::group(['prefix' => "signup"], function () use ($prefix) {
        Route::get('', 'marcusvbda\laravelstack\Http\Controllers\AuthController@signup')->name("laravelstack.signup");
        Route::post('', 'marcusvbda\laravelstack\Http\Controllers\AuthController@createUser')->name("laravelstack.createUser");
        Route::get('{token}/confirm_account', 'marcusvbda\laravelstack\Http\Controllers\AuthController@confirmAccount')->name("laravelstack.confirmAccount");
    });
});
