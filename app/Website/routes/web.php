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

Route::group(['middleware' => ['web']], function () use ($route) {
    Route::get('/', function () {
        return view('website::home');
    })->name('home');

    Route::get('/donate', function () {
        return view('website::donate');
    })->name('donate');
});