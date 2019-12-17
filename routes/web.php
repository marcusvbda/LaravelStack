<?php

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => "admin"], function () {
    require "partials/auth.php";
    Route::group(['middleware' => 'auth'], function () {
        Route::get('debug', 'DebugController@index')->name("debug.index");
        Route::get('', 'HomeController@index')->name("admin.home");
        require "partials/account.php";
    });
});
