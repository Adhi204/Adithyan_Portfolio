<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Resume;
use App\Models\Service;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\UserSkill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $data = config('portfolio');

        $user = User::create([
            'email' => $data['user']['email'],
            'password' => Hash::make($data['user']['password']),
        ]);

        UserProfile::create([
            'user_id' => $user->id,
            ...$data['profile'],
        ]);

        foreach ($data['skills'] as $skill) {
            UserSkill::create([
                'user_id' => $user->id,
                ...$skill,
            ]);
        }

        foreach ($data['projects'] as $project) {
            Project::create([
                'user_id' => $user->id,
                ...$project,
            ]);
        }

        Resume::create([
            'user_id' => $user->id,
            ...$data['resume'],
        ]);

        foreach ($data['services'] as $service) {
            Service::create([
                'user_id' => $user->id,
                ...$service,
            ]);
        }
    }
}
