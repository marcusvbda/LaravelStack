<?php
Route::group(['prefix' => "auth"], function () {
    Route::group(['prefix' => "login"], function () {
        Route::get('', 'Auth\LoginController@index')->name("auth.login.index");
        Route::post('', 'Auth\LoginController@signin')->name("auth.signin.post");
        $login_social = [
            "facebook" => config("services.facebook"),
            "google"   => config("services.google"),
        ];
        if($login_social["facebook"]["client_id"] || $login_social["google"]["client_id"])  require("socialite.php");
    });
    Route::group(['prefix' => "signup"], function () {
        Route::get('', 'Auth\RegisterController@index')->name("auth.signup.index");
        Route::post('', 'Auth\RegisterController@store')->name("auth.signup.store");
        Route::get('{token}/confirm_account', 'Auth\RegisterController@confirmAccount')->name("auth.signup.confirm");
    });
    Route::group(['prefix' => "forgot_my_password"], function () {
        Route::get('', 'Auth\ForgotPasswordController@index')->name("auth.forgot_my_password.index");
        Route::post('', 'Auth\ForgotPasswordController@resetPassword')->name("auth.forgot_my_password.reset");
        Route::get('{token}/renew_password', 'Auth\ForgotPasswordController@renewPassword')->name("auth.forgot_my_password.renew");
        Route::post('{token}/renew_password', 'Auth\ForgotPasswordController@setPassword')->name("auth.forgot_my_password.set");
    });
});
