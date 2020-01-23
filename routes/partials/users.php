<?php
Route::group(['prefix' => "users"], function () {
    Route::post('store', 'Auth\UsersController@store');
    Route::get('import', 'Auth\UsersController@import');
    Route::post('import/submit', 'Auth\UsersController@importSubmit');
});
