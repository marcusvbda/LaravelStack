<?php
Route::group(['prefix' => "admin"], function () {
    Route::group(['middleware' => ['web', 'auth']], function () {
        Route::post('store', '\App\vStack\Controllers\ResourceController@store')->name("resource.store");
        Route::get('{resource}', '\App\vStack\Controllers\ResourceController@index')->name("resource.index");
        Route::get('{resource}/create', '\App\vStack\Controllers\ResourceController@create')->name("resource.create");
        Route::get('{resource}/export', '\App\vStack\Controllers\ResourceController@export')->name("resource.export");
        Route::get('{resource}/import', '\App\vStack\Controllers\ResourceController@import')->name("resource.import");
        Route::post('{resource}/import/check_file', '\App\vStack\Controllers\ResourceController@checkFileImport')->name("resource.import.check_file");
        Route::post('{resource}/import/submit', '\App\vStack\Controllers\ResourceController@importSubmit')->name("resource.import.submit");
        Route::post('{resource}/custom-cards/store', '\App\vStack\Controllers\ResourceController@customCardStore')->name("resource.customcard.store");
        Route::get('{resource}/{code}', '\App\vStack\Controllers\ResourceController@view')->middleware(['hashids:code'])->name("resource.view");
        Route::get('{resource}/{code}/edit', '\App\vStack\Controllers\ResourceController@edit')->middleware(['hashids:code'])->name("resource.edit");
        Route::delete('{resource}/{code}/destroy', '\App\vStack\Controllers\ResourceController@destroy')->middleware(['hashids:code'])->name("resource.destroy");
        Route::post('inputs/option_list', '\App\vStack\Controllers\ResourceController@option_list')->name("resource.inputs.option_list");
        Route::post('globalsearch', '\App\vStack\Controllers\ResourceController@globalSearch')->name("resource.globalsearch");
        Route::post('{resource}/metric-calculate/{key}', '\App\vStack\Controllers\ResourceController@metricCalculate')->name("resource.metricCalculate");
    });
});
