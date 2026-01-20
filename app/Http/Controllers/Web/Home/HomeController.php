<?php

namespace App\Http\Controllers\Web\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    /**
     * Define the routes for the LoginController.
     * This method should be called in the routes file to register the routes.
     * 
     * @return void
     * @see \App\Library\Interfaces\Routable
     */
    public static function routes(): void
    {
        Route::prefix('home')
            ->controller(self::class)
            ->group(function () {
                Route::get('dashboard', 'index')->name('home.dashboard');
            });
    }


    public function index()
    {
        $projects = [
            [
                'title' => 'Bid Application',
                'description' => 'A Laravel-based bidding platform with admin moderation.',
                'url' => '#',
            ],
            [
                'title' => 'Log Viewer Dashboard',
                'description' => 'API-driven log viewer using Laravel Log Viewer.',
                'url' => '#',
            ],
        ];

        return view('test', compact('projects'));
    }
}
