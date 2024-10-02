<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/message', function () {
    return view('msg');
});

Route::get('/dashboard', function () {
    return view('index');
});

Route::get('/buy', function () {
    return view('buy');
});

Route::get('/addbroadcast', function () {
    return view('bc');
});

Route::get('/broadcast', function () {
    return view('bc_list');
});

Route::get('/draft', function () {
    return view('draft');
});

Route::get('/package', function () {
    return view('package');
});

Route::get('/notification', function () {
    return view('notif');
});


Route::get('/setting', function () {
    return view('settings');
});

Route::get('/logout', function () {
    return view('logout');
});
