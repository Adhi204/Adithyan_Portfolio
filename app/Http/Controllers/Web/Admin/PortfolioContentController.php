<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateRequest;
use App\Models\PortfolioContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class PortfolioContentController extends Controller
{
    /**
     * Define the middleware that should be applied to routes in this controller.
     *
     * @return array
     */
    public static function middleware(): array
    {
        return [];
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
        Route::prefix('portfolio_content')
            ->controller(self::class)
            ->group(function () {
                Route::get('about', 'about')->name('admin.about');
                Route::get('skills', 'skills')->name('admin.skills');
                Route::get('resume', 'resume')->name('admin.resume');
                Route::get('projects', 'projects')->name('admin.projects');

                Route::post('{portfolio}/update', 'update')->name('admin.update');
                Route::get('profile', 'profile')->name('portfolio.profile');
            });
    }

    /**
     * about update page
     */
    public function about()
    {
        return view('admin.about');
    }

    /**
     * skills update page
     */
    public function skills()
    {
        return view('admin.skills');
    }

    /**
     * resume update page
     */
    public function resume()
    {
        return view('admin.resume');
    }

    /**
     * projects update page
     */
    public function projects()
    {
        return view('admin.projects');
    }

    /**
     * Update portfolio content.
     */
    public function update(UpdateRequest $request, PortfolioContent $portfolio)
    {
        // TITLE
        if ($request->has('title')) {
            $portfolio->title = $request->title;
            $portfolio->description = $request->description;
        }

        // DESCRIPTION
        if ($request->has('description')) {
            $portfolio->description = $request->description;
        }

        // SKILLS
        if ($request->has('skills')) {
            $portfolio->skills = $request->skills;
        }

        // RESUME
        if ($request->hasFile('resume')) {
            $portfolio->updateResume($request->file('resume'));
        }

        $portfolio->save();

        return redirect()->route('admin.dashboard')->with('success', 'Updated successfully');
    }

    /**
     * Show the portfolio profile page.
     */
    public function profile()
    {
        $content = PortfolioContent::latest()->first();

        return view('profile')->with('content', $content);
    }
}
