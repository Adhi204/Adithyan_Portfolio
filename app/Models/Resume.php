<?php

namespace App\Models;

use App\Services\DocumentService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class Resume extends Model
{
    // Path to the avatar directory to store profile pictures
    protected const DOCUMENT_PATH = 'documents';

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'file_name',
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
     * Save resume to disk and set file_name field of Model
     *
     * @param mixed $resume uploaded resume file
     * @return void
     */
    public function saveResume($file): void
    {
        if ($this->file_name) {
            $this->deleteResume();
        }

        $this->file_name = DocumentService::save($file, self::DOCUMENT_PATH);
    }

    // Delete resume from disk and and set file_name field of Model
    public function deleteResume(): void
    {
        DocumentService::delete(self::DOCUMENT_PATH . '/' . $this->file_name);

        $this->file_name = null;
    }

    /**
     * Save resume from a url to disk and set file_name field of Model
     *
     * @param string $url url for the resume file
     * @return void
     */
    public function saveResumeFromUrl(string $url): void
    {
        $this->file_name = DocumentService::saveFromUrl($url, self::DOCUMENT_PATH);
    }

    /**
     * Get resume URL.
     * 
     * @return string|null
     */
    public function getResumeUrl(): ?string
    {
        return $this->file_name ?
            DocumentService::url(self::DOCUMENT_PATH . '/' . $this->file_name) :
            null;
    }
}
