<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/portfolio', function () {
    return view('portfolio');
});

Route::get('/skills', function () {
    return view('skills');
});

Route::get('/resume', function () {
    return view('resume');
});
