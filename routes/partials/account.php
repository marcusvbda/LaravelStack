<?php
Route::group(['prefix' => "account"], function () {
    Route::group(['prefix' => "profile"], function () {
        Route::get('', 'Auth\RegisterController@profile')->name("admin.account.profile");
        Route::post('', 'Auth\RegisterController@editProfile')->name("admin.account.profile.edit");
    });
});
