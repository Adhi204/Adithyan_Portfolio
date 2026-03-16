<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AddProjectRequest;
use App\Http\Requests\Admin\AddSkillRequest;
use App\Http\Requests\Admin\UpdateProfileRequest;
use App\Http\Requests\Admin\UpdateProjectRequest;
use App\Http\Requests\Admin\UpdateResumeRequest;
use App\Http\Requests\Admin\UpdateServiceRequest;
use App\Models\Project;
use App\Models\Resume;
use App\Models\Service;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\UserSkill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class DashboardController extends Controller
{
    /**
     * Define the middlewares for the controller.
     *
     * @return array<int, \Illuminate\Routing\Middleware>
     */
    public static function middleware(): array
    {
        return [
            'auth',
            'admin',
        ];
    }

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
                Route::get('dashboard', 'dashboard')->name('admin.dashboard');

                Route::post('updateProfile', 'updateProfile')->name('admin.updateProfile');

                Route::post('addProject', 'addProject')->name('admin.addProject');
                Route::post('{project}/updateProject', 'updateProject')->name('admin.updateProject');
                Route::post('{project}/deleteProject', 'deleteProject')->name('admin.deleteProject');

                Route::post('addSkill', 'addSkill')->name('admin.addSkill');
                Route::post('{skill}/deleteSkill', 'deleteSkill')->name('admin.deleteSkill');

                Route::post('updateResume', 'updateResume')->name('admin.updateResume');

                Route::post('{service}/updateService', 'updateService')->name('admin.updateService');
            });
    }

    /**
     * Display the admin dashboard.
     */
    public function dashboard()
    {
        $user = User::with(['profile', 'skills', 'projects', 'resumes'])->first();
        return view('admin.dashboard')->with('user', $user);
    }

    /**
     * Update the user's profile information.
     */
    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = $request->user();

        $profile = UserProfile::where('user_id', $user->id)->first();

        $profile->name = $request->safe()->name;
        $profile->designation = $request->safe()->designation;
        $profile->about = $request->safe()->about;
        $profile->location = $request->safe()->location;
        $profile->phone = $request->safe()->phone;
        $profile->email = $request->safe()->email;
        $profile->linkedin_link = $request->safe()->linkedin_link;
        $profile->github_link = $request->safe()->github_link;


        if ($request->hasFile('avatar')) {
            $profile->saveAvatar($request->file('avatar'));
        }

        $profile->save();

        return back()->with([
            'message' => 'Profile updated successfully',
            'message_type' => 'success',
        ]);
    }

    /**
     * Add a new project to the user's portfolio.
     */
    public function addProject(AddProjectRequest $request)
    {
        $user = $request->user();

        Project::create([
            'user_id' => $user->id,
            'title' => $request->safe()->title,
            'description' => array_filter(array_map('trim', explode("\n", $request->description))),
            'github_url' => $request->safe()->github_url,
            'live_url' => $request->safe()->live_url
        ]);

        return back()->with([
            'message' => 'Project added successfully',
            'message_type' => 'success',
        ]);
    }

    public function updateProject(UpdateProjectRequest $request, Project $project)
    {
        $project->update([
            'title' => $request->safe()->title,
            'description' => array_filter(array_map('trim', explode("\n", $request->description))),
            'github_url' => $request->safe()->github_url,
            'live_url' => $request->safe()->live_url
        ]);

        return back()->with([
            'message' => 'Project updated successfully',
            'message_type' => 'success',
        ]);
    }

    /**
     * Delete a project from the user's portfolio.
     */
    public function deleteProject(Project $project)
    {
        $project->delete();
        return back()->with([
            'message' => 'Project deleted successfully',
            'message_type' => 'success',
        ]);
    }

    /**
     * Add a new skill to the user's profile.
     */
    public function addSkill(AddSkillRequest $request)
    {
        $user = $request->user();

        UserSkill::create([
            'user_id' => $user->id,
            'name' => $request->safe()->name,
            'level' => $request->safe()->level,
        ]);

        return back()->with([
            'message' => 'Skill added successfully',
            'message_type' => 'success',
        ]);
    }

    /**
     * Delete a skill from the user's profile.
     */
    public function deleteSkill(UserSkill $skill)
    {
        $skill->delete();
        return back()->with([
            'message' => 'Skill deleted successfully',
            'message_type' => 'success',
        ]);
    }

    /**
     * Update the user's resume.
     */
    public function updateResume(UpdateResumeRequest $request)
    {
        $user = $request->user();

        $resume = Resume::where('user_id', $user->id)->first();

        // Update title (safe validated data)
        if ($request->safe()->title) {
            $resume->title = $request->safe()->title;
        }

        // Handle file upload using model method
        if ($request->hasFile('file')) {
            $resume->saveResume($request->file('file'));
        }


        $resume->save();

        return back()->with([
            'message' => 'Resume updated successfully',
            'message_type' => 'success',
        ]);
    }

    /**
     * Update the user's service information.
     */
    public function updateService(UpdateServiceRequest $request, Service $service)
    {
        $service->update([
            'title' => $request->safe()->title,
            'description' => $request->safe()->description,
        ]);

        return redirect()->back()->with([
            'message' => 'Service updated successfully',
            'message_type' => 'success',
        ]);
    }
}
