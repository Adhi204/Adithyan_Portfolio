<?php

use App\Http\Controllers\Web\Admin\AdminController;
use App\Http\Controllers\Web\Admin\PortfolioContentController;
use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\Home\HomeController;
use Illuminate\Support\Facades\Route;

LoginController::routes();
AdminController::routes();
PortfolioContentController::routes();
HomeController::routes();

// public routes
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
