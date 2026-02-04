<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::with(['profile', 'skills', 'projects', 'resumes'])->first();
        return view('admin.dashboard')->with('user', $user);
    }
}
