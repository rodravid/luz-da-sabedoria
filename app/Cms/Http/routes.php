<?php

Route::group(['middleware' => ['web']], function () {

    Route::get('login', 'Auth\\AuthController@showLoginForm')->name('login.show');
    Route::post('login', 'Auth\\AuthController@login')->name('login');
    Route::get('logout', 'Auth\\AuthController@logout')->name('logout');
    Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
    Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\PasswordController@reset');

    Route::group(['middleware' => ['auth:cms', 'cms']], function() {
        Route::get('/', 'Dashboard\\DashboardController@index')->name('dashboard.show');
        Route::post('settings/{key}/{value}', 'Settings\\SettingsController@store')->name('settings.store');

        Route::group(['prefix' => 'projects', 'as' => 'projects.'], function () {
            Route::get('/', 'Project\\ProjectController@index')->name('list');
            Route::get('/new', 'Project\\ProjectController@create')->name('create');
            Route::post('/', 'Project\\ProjectController@store')->name('create#store');
            Route::get('/edit/{post}', 'Project\\ProjectController@edit')->name('edit');
            Route::put('/{post}', 'Project\\ProjectController@update')->name('edit#update');
            Route::delete('/{post}/delete', 'Project\\ProjectController@delete')->name('destroy');
            Route::post('/datatable', 'Project\\ProjectController@datatable')->name('list#datatable');

            Route::delete('/{project}/remove-banner', 'Project\\ProjectController@removeBanner')->name('edit#remove-banner');
        });
    });

});