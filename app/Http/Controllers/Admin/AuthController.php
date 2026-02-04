<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\RequestService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
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
}
