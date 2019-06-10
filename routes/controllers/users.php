<?php

// -- ROUTE PATTERN
Route::pattern('user', '[0-9]+');
Route::pattern('role', '[0-9]+');
Route::pattern('permission', '[0-9]+');

// -- ROUTE MODEL BINDING
Route::bind('user', function ($value) {
    return App\Models\User::withTrashed()
        -> where('id', $value)
        -> firstOrFail();
});

Route::bind('role', function ($value) {
    return App\Models\Role::withTrashed()
        -> where('id', $value)
        -> firstOrFail();
});

Route::bind('permission', function ($value) {
    return App\Models\Permission::withTrashed()
        -> where('id', $value)
        -> firstOrFail();
});

Route::bind('group', function ($value) {
    return App\Models\PermissionGroup::withTrashed()
        -> where('id', $value)
        -> firstOrFail();
});


// -- ROUTING GROUP
//Route::group(['prefix' => 'users', 'middleware' => 'acl'], function() {
Route::group(['prefix' => 'users'], function () {
    Route::get('/{user}/login-count', 'UsersController@loginCount') -> name('login-counts') -> middleware('only.ajax');

    Route::get('/', 'UsersController@index') -> name('users-index');
    Route::post('/', 'UsersController@index') -> name('users-index-filter');

    Route::get('/trash', 'UsersController@trash') -> name('users-trash');
    Route::post('/trash', 'UsersController@trash') -> name('users-trash-filter');

    Route::get('/password/{user?}', ['as' => 'users-change-password',       'uses' => 'UsersController@changePassword']);
    Route::patch('/password/{user?}', ['as' => 'users-do-change-password',    'uses' => 'UsersController@changePassword']);

    Route::get('/{user}', 'UsersController@show') -> name('users-show');
    Route::get('/profile/{user?}', 'UsersController@profile') -> name('users-profile');
    Route::get('/create', 'UsersController@create') -> name('users-create');
    Route::post('/store', 'UsersController@store') -> name('users-store');
    Route::get('/{user}/edit', 'UsersController@edit') -> name('users-edit');
    Route::patch('/{user}', 'UsersController@update') -> name('users-update');

    Route::get('/{user}/delete', 'UsersController@delete') -> name('users-delete');
    Route::post('/bulk-delete', 'UsersController@deleteBulk') -> name('users-delete-bulk');
    Route::get('/{user}/restore', 'UsersController@restore') -> name('users-restore');
    Route::post('/bulk-restore', 'UsersController@restoreBulk') -> name('users-restore-bulk');
    Route::get('/{user}/destroy', 'UsersController@destroy') -> name('users-destroy');

    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', 'UsersRolesController@index') -> name('users-roles-index');
        Route::get('/trash', 'UsersRolesController@trash') -> name('users-roles-trash');
        Route::get('/create', 'UsersRolesController@create') -> name('users-roles-create');
        Route::post('/', 'UsersRolesController@store') -> name('users-roles-store');
        Route::get('/{role}/edit', 'UsersRolesController@edit') -> name('users-roles-edit');
        Route::patch('/{role}', 'UsersRolesController@update') -> name('users-roles-update');
        Route::get('/{role}/delete', 'UsersRolesController@delete') -> name('users-roles-delete');
        Route::post('/bulk-delete', 'UsersRolesController@deleteBulk') -> name('users-roles-delete-bulk');
        Route::get('/{role}/restore', 'UsersRolesController@restore') -> name('users-roles-restore');
        Route::post('/bulk-restore', 'UsersRolesController@restoreBulk') -> name('users-roles-restore-bulk');
    });

    Route::group(['prefix' => 'permissions'], function () {
        Route::get('/', 'UsersPermissionsController@index') -> name('users-permissions-index');
        Route::get('/trash', 'UsersPermissionsController@trash') -> name('users-permissions-trash');
        Route::get('/create', 'UsersPermissionsController@create') -> name('users-permissions-create');
        Route::post('/', 'UsersPermissionsController@store') -> name('users-permissions-store');
        Route::get('/{permission}/edit', 'UsersPermissionsController@edit') -> name('users-permissions-edit');
        Route::patch('/{permission}', 'UsersPermissionsController@update') -> name('users-permissions-update');
        Route::get('/{permission}/delete', 'UsersPermissionsController@delete') -> name('users-permissions-delete');
        Route::post('/bulk-delete', 'UsersPermissionsController@deleteBulk') -> name('users-permissions-delete-bulk');
        Route::get('/{permission}/restore', 'UsersPermissionsController@restore') -> name('users-permissions-restore');
        Route::post('/bulk-restore', 'UsersPermissionsController@restoreBulk') -> name('users-permissions-restore-bulk');
    });

    Route::group(['prefix' => 'permissions-groups'], function () {
        Route::get('/', 'UsersPermissionsGroupsController@index') -> name('users-permissions-groups-index');
        Route::get('/trash', 'UsersPermissionsGroupsController@trash') -> name('users-permissions-groups-trash');
        Route::get('/create', 'UsersPermissionsGroupsController@create') -> name('users-permissions-groups-create');
        Route::post('/', 'UsersPermissionsGroupsController@store') -> name('users-permissions-groups-store');
        Route::get('/{group}/edit', 'UsersPermissionsGroupsController@edit') -> name('users-permissions-groups-edit');
        Route::patch('/{group}', 'UsersPermissionsGroupsController@update') -> name('users-permissions-groups-update');
        Route::get('/{group}/delete', 'UsersPermissionsGroupsController@delete') -> name('users-permissions-groups-delete');
        Route::post('/bulk-delete', 'UsersPermissionsGroupsController@deleteBulk') -> name('users-permissions-groups-delete-bulk');
        Route::get('/{group}/restore', 'UsersPermissionsGroupsController@restore') -> name('users-permissions-groups-restore');
        Route::post('/bulk-restore', 'UsersPermissionsGroupsController@restoreBulk') -> name('users-permissions-groups-restore-bulk');
    });
});
