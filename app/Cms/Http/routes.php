<?php

Route::group(['middleware' => ['web']], function () use ($route) {

    Route::get('login', 'Auth\\AuthController@showLoginForm')->name('login.show');
    Route::post('login', 'Auth\\AuthController@login')->name('login');
    Route::get('logout', 'Auth\\AuthController@logout')->name('logout');
    Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
    Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\PasswordController@reset');

    Route::group(['middleware' => ['auth:cms', 'cms']], function() use ($route) {
        Route::get('/', 'Dashboard\\DashboardController@index')->name('dashboard.show');
        Route::post('settings/{key}/{value}', 'Settings\\SettingsController@store')->name('settings.store');
    });

});