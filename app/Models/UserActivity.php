<?php

namespace App\Models;

use App\Enums\Users\Activities;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserActivity extends Model
{
    /**
     * Indicates if the model should be timestamped.
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'activity',
        'data',
        'ip_address',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'activity' => Activities::class,
            'created_at' => 'immutable_datetime',
        ];
    }

    /** Relationships */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
