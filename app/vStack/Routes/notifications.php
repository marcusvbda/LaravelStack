<?php
Route::group(['prefix' => "admin"], function () {
    Route::group(['prefix' => "vstack"], function () {
        Route::group(['middleware' => ['web', 'auth']], function () {
            Route::group(['prefix' => "notifications"], function () {
                Route::post('{user}', '\App\vStack\Controllers\NotificationsController@get')->middleware(['hashids:user','bindings'])->name("notifications.get");
                Route::post('{user}/set_as_readed', '\App\vStack\Controllers\NotificationsController@setAsReaded')->middleware(['hashids:user','bindings'])->name("notifications.set_as_readed");
            });
        });
    });
});
