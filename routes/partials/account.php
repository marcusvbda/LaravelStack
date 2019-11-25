<?php
Route::group(['prefix' => "account"], function () {
    Route::group(['prefix' => "profile"], function () {
        Route::get('', 'Admin\AccountController@profile')->name("admin.account.profile");
        Route::post('', 'Admin\AccountController@editProfile')->name("admin.account.profile.edit");
    });
    // Route::get('{user}', 'Admin\AccountController@index')->middleware(['hashids:user', 'bindings'])->name("admin.account.index");
});
