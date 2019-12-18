<?php

Route::group(['prefix' => "social"], function () {
    Route::get('{provider}', 'Auth\LoginController@redirectToProvider')->name("login_social");
    Route::get('{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name("login_social.callback");
});
