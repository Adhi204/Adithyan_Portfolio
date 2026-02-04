<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string'],
            'avatar' => ['nullable', 'image', 'max:1024', 'mimetypes:image/jpeg,image/png,image/gif,image/webp'],
            'designation' => ['nullable', 'string'],
            'about' => ['nullable', 'string'],
            'location' => ['nullable', 'string'],
            'phone' => ['nullable', 'string', 'max:13', 'unique:user_profiles,phone'],
            'email' => ['nullable', 'email', 'unique:user_profiles,email'],
            'linkedin_link' => ['nullable', 'string'],
            'github_link' => ['nullable', 'string'],
        ];
    }
}
