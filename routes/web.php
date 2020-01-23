<?php
Route::domain('{subdomain}.' . parse_url(config('app.url'), PHP_URL_HOST))->group(function ($subdomain) {
    Route::get('/', function ($subdomain) {
        return "landing Page usuario ".$subdomain;
    });
});

Route::get('/', function () {
    return "landing Page Principal ";
});
Route::group(['prefix' => "admin"], function () {
    require "partials/auth.php";
    Route::group(['middleware' => 'auth'], function () {
        Route::get('debug', 'DebugController@index')->name("debug.index");
        Route::get('', 'HomeController@index')->name("admin.home");
        require "partials/account.php";
        require "partials/users.php";
    });
});
