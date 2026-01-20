<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Enums\Users\Activities;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class LoginController extends Controller
{
    /**
     * Define the middleware that should be applied to routes in this controller.
     *
     * @return array
     */
    public static function middleware(): array
    {
        return [
            new Middleware('auth:sanctum', except: ['loginForm', 'login'])
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
        Route::get('admin/login', [self::class, 'loginForm'])->name('login');
        Route::post('admin/login', [self::class, 'login']);
        Route::post('logout', [self::class, 'logout'])->name('logout');
    }

    /**
     * Show the login form.
     */
    public function loginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials, $request->filled('remember'))) {
            return back()->withErrors([
                'message' => 'Invalid credentials.',
            ]);
        }

        $user = Auth::user();

        $user->logActivity(Activities::UserLoggedIn, null, $request->ip());

        return redirect()->route('admin.dashboard');
    }
}
