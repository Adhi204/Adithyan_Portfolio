<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Users\Activities;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

class AuthController extends Controller
{
    /**
     * Define the routes for the controller.
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
                Route::get('/login', 'show')->name('admin.show');
                Route::post('/login', 'login')->name('admin.login');
                Route::post('/logout', 'logout')->name('admin.logout');
                Route::post('/updatePassword', 'updatePassword')->name('admin.updatePassword');
            });
    }

    // Show login form
    public function show()
    {
        return view('admin.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        // Attempt login only if user is admin
        if (Auth::attempt(array_merge($credentials, ['is_admin' => true]))) {
            $request->session()->regenerate(); // secure the session

            // Redirect to dashboard
            return redirect()->route('admin.dashboard')->with([
                "message" => "Login Successfully",
                "message_type" => "success",
            ]);
        }

        return back()->withErrors([
            'email' => 'The credentials do not match our records or you are not an admin.',
        ])->onlyInput('email');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        return redirect()->route('admin.login')->with([
            "message" => "Logged out successfully",
            "message_type" => "success",

        ]);
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = $request->user();
        $oldPassword = $request->safe()->input('old_password');

        if (!Hash::check($oldPassword, $user->password)) {
            return back()->with([
                'message' => 'Old password is incorrect',
                'message_type' => 'error'
            ]);
        }

        $user->update(['password' => $request->safe()->password]);

        $user->logActivity(Activities::UserUpdatedPassword, null, $request->ip());

        return back()->with([
            'message' => 'Password updated successfully',
            'message_type' => 'success'
        ]);
    }
}
