<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'designation' => $this->designation,
            'about' => $this->about,
            'avatar' => $this->getAvatarUrl(),
            'location' => $this->location,
            'phone' => $this->phone,
            'email' => $this->email,
            'linkedin_link' => $this->linkedin_link,
            'github_link' => $this->github_link,

        ];
    }
}
