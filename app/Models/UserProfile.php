<?php

namespace App\Models;

use App\Services\ImageService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class UserProfile extends Model
{
    // Path to the avatar directory to store profile pictures
    protected const AVATAR_PATH = 'avatars';

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'designation',
        'about',
        'avatar',
        'location',
        'phone',
        'email',
        'linkedin_link',
        'github_link',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        //
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'created_at' => 'immutable_datetime',
            'updated_at' => 'immutable_datetime',
        ];
    }

    /** Relationships */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Save avatar to disk and set avatar field of Model
     *
     * @param mixed $image uploaded image file
     * @return void
     */
    public function saveAvatar($image): void
    {
        if ($this->avatar) {
            $this->deleteAvatar();
        }

        $this->avatar = ImageService::save($image, self::AVATAR_PATH);
    }

    // Delete avatar image from disk and and set avatar field of Model
    public function deleteAvatar(): void
    {
        ImageService::delete(self::AVATAR_PATH . '/' . $this->avatar);

        $this->avatar = null;
    }

    /**
     * Save avatar image from a url to disk and set avatar field of Model
     *
     * @param string $url url for the image file
     * @return void
     */
    public function saveAvatarFromUrl(string $url): void
    {
        $this->avatar = ImageService::saveFromUrl($url, self::AVATAR_PATH);
    }

    /**
     * Get avatar URL.
     * 
     * @return string|null
     */
    public function getAvatarUrl(): ?string
    {
        return $this->avatar ?
            ImageService::url(self::AVATAR_PATH . '/' . $this->avatar) :
            null;
    }
}
