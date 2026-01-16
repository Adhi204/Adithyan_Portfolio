<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\Users\Activities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationships    

    public function activities(): HasMany
    {
        return $this->hasMany(UserActivity::class);
    }

    /**
     * Log an activity for this user.
     *
     * @param Activities $activity
     * @param ?array $data
     * @param string $ipAddress
     */
    public function logActivity(Activities $activity, ?array $data, string $ipAddress): void
    {
        $jsonData = $data ? json_encode($data) : null;

        $this->activities()->create([
            'activity' => $activity,
            'data' => $jsonData,
            'ip_address' => $ipAddress,
        ]);
    }
}
