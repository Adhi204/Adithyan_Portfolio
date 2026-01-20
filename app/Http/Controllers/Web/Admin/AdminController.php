<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class AdminController extends Controller
{
    /**
     * Define the middleware that should be applied to routes in this controller.
     *
     * @return array
     */
    public static function middleware(): array
    {
        return [
            'auth',
        ];
    }

    /**
     * Define the routes for the LoginController.
     * This method should be called in the routes file to register the routes.
     * 
     * @return void
     * @see \App\Library\Interfaces\Routable
     */
    public static function routes(): void
    {
        Route::prefix('admin')
            ->controller(self::class)
            ->group(function () {
                Route::get('dashboard', 'dashboard')->name('admin.dashboard');
            });
    }

    /**
     * Show the admin dashboard.
     */
    public function dashboard()
    {
        abort_unless(auth()->user(), 403);

        return view('admin.dashboard');
    }
}
