<?php

/*

// -- ROUTE PATTERN
Route::pattern('dummy', '[0-9]+');

// -- ROUTE MODEL BINDING
Route::bind('dummy', function ($value) {
    return App\Models\Model::withTrashed()
                -> where('id', '=', $value)
                -> firstOrFail();
});

// -- ROUTING GROUP
Route::group(['prefix' => 'dummy'], function () {
    Route::get('/', 'DummyController@index') -> name('dummy-index');
    Route::post('/', 'DummyController@index') -> name('dummy-index-filter');

    Route::get('/trash', 'DummyController@trash') -> name('dummy-trash');
    Route::post('/trash', 'DummyController@trash') -> name('dummy-trash-filter');

    Route::get('/{dummy}', 'DummyController@show') -> name('dummy-show');
    Route::get('/{dummy}/books', 'DummyController@books') -> name('dummy-books');

    Route::get('/dummy', 'DummyController@create') -> name('dummy-create');
    Route::post('/store', 'DummyController@store') -> name('dummy-store');
    Route::get('/{dummy}/edit', 'DummyController@edit') -> name('dummy-edit');
    Route::patch('/{dummy}', 'DummyController@update') -> name('dummy-update');

    Route::get('/{dummy}/delete', 'DummyController@delete') -> name('dummy-delete');
    Route::post('/bulk-delete', 'DummyController@deleteBulk') -> name('dummy-delete-bulk');
    Route::get('/{dummy}/restore', 'DummyController@restore') -> name('dummy-restore');
    Route::post('/bulk-restore', 'DummyController@restoreBulk') -> name('dummy-restore-bulk');
    Route::get('/{dummy}/destroy', 'DummyController@destroy') -> name('dummy-destroy');
});

*/
