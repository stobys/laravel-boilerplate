<?php

// Route::get('/login',    ['uses' => 'Auth\LoginController@showLoginForm',  'as' => 'login']);
// Route::post('/login',   ['uses' => 'Auth\LoginController@login', 'as' => 'doLogin']);
// Route::get('/logout',   ['uses' => 'Auth\LoginController@logout', 'as' => 'logout']);

// // Route::get('/loginGit',    ['uses' => 'Auth\LoginController@showLoginForm',  'as' => 'login']);

// Route::get('login/live', 'TestController@redirectToProvider');
// Route::get('login/live/callback', 'TestController@handleProviderCallback');


// -- Authentication Routes
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('doLogin');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// -- Change Password Routes
Route::get('password/change', 'Auth\ChangePasswordController@showChangePasswordForm')->name('password-change');
Route::patch('password/change', 'Auth\ChangePasswordController@changePassword')->name('password-change');

// -- Password Reset Routes
Route::get('password-reset', 'Auth\ForgotPasswordController@showLinkRequestForm') -> name('password-reset');
// opens auth.passwords.email view
// sends form via post to roue(password-reset-email)


Route::post('password-reset-email', 'Auth\ForgotPasswordController@sendResetLinkEmail') -> name('password-reset-email');
// opens
//

Route::get('password-reset/{token}', 'Auth\ResetPasswordController@showResetForm') -> name('password-reset-token');
Route::post('password-reset', 'Auth\ResetPasswordController@reset') -> name('password-reset');


// -- Account Register Routes
Route::get('register', 'Auth\RegisterController@showRegistrationForm') -> name('register');
Route::post('register', 'Auth\RegisterController@register') -> name('register');
