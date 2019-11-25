<?php

Route::get('{resource}', 'ResourceController@index')->name("resource.index");
Route::get('{resource}/{code}', 'ResourceController@edit')->middleware(['hashids:code'])->name("resource.edit");
