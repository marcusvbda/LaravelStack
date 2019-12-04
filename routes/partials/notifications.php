<?php
Route::group(['prefix' => "notifications"], function () {
    Route::post('{user}', 'NotificationsController@get')->middleware(['hashids:user','bindings'])->name("notifications.get");
    Route::post('{user}/set_as_readed', 'NotificationsController@setAsReaded')->middleware(['hashids:user','bindings'])->name("notifications.set_as_readed");
});
