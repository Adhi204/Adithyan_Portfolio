<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
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

    // Admin login
    Route::get('/login', [AuthController::class, 'show'])->name('admin.show');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login');
    Route::post('logout', [AuthController::class, 'logout'])->name('admin.logout');
});

DashboardController::routes();
