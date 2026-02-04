<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        $user = User::with([
            'profile',
            'skills',
            'projects',
            'resumes',
            'services',
        ])->first();

        if (!$user) {
            return response()->json([
                'message' => 'Portfolio not found'
            ], 404);
        }

        return response()->json([
            'profile' => $user->profile,
            'skills' => $user->skills,
            'projects' => $user->projects,
            'resume' => $user->resumes->first(),
            'services' => $user->services,
        ]);
    }
}
