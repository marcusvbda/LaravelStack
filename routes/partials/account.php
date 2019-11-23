<?php
Route::group(['prefix' => "account"], function () {
    Route::get('{user}', 'Admin\AccountController@index')->middleware(['hashids:user', 'bindings'])->name("admin.account.index");
});
