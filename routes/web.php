<?php

use App\Http\Controllers\Web\Admin\AdminController;
use App\Http\Controllers\Web\Admin\PortfolioContentController;
use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\Home\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public portfolio page
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('portfolio.index');
});

/*
|--------------------------------------------------------------------------
| Admin routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {

    //
});
