<?php
Route::group(['prefix' => "admin"], function () {
    Route::group(['prefix' => "vstack"], function () {
        Route::group(['middleware' => ['web', 'auth']], function () {
            Route::group(['prefix' => "notifications"], function () {
                Route::post('{user}', '\App\vStack\Controllers\NotificationsController@get')->middleware(['hashids:user','bindings'])->name("notifications.get");
                Route::delete('{user}/{id}/destroy', '\App\vStack\Controllers\NotificationsController@destroy')->middleware(['hashids:user','bindings'])->name("notifications.destroy");
            });
        });
    });
});
