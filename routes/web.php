<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// -- Web Routes
Route::get('/alter-page-size', 'Actions\AlterPageSize') -> name('alter-page-size');
// Route::get('/alter-page-size', 'HomeController@home') -> name('home');
// Route::get('/', 'HomeController@home') -> name('home');
// Route::get('test/{function?}', 'TestController@dispatch') -> name('test');

// Route::post('/sidebar-settings', 'SettingsController@sidebar') -> name('sidebar-settings');



// -- load controllers routes
foreach (File::files(dirname(__FILE__) . DIRECTORY_SEPARATOR .'controllers') as $file) {
    include($file);
}

// Route::any('/{page?}', 'HomeController@notFound') -> where('page','.*') -> name('catchAll');

Route::get('/', 'HomeController@index') -> name('root');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'HomeController@index')->name('dashboard');
Route::get('/search', 'HomeController@search') -> name('search');
