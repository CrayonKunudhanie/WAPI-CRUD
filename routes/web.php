<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/msg', function () {
    return view('msg');
});

Route::get('/dashboard', function () {
    return view('index');
}); 

Route::get('/buy', function() {
    return view('buy');
});
