<?php

namespace App\Models;

use App\Services\DocumentService;
use Illuminate\Database\Eloquent\Model;

class PortfolioContent extends Model
{
    // Path to the documents directory to store customer documents
    protected const DOCUMENTS_PATH = 'resume';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'description',
        'skills',
        'resume',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'skills' => 'array',
            'created_at' => 'immutable_datetime',
            'updated_at' => 'immutable_datetime',
        ];
    }


    /**
     * Save document to disk and set resume field of Model
     *
     * @param mixed $image uploaded file
     * @param string $customerId
     * @param DocumentTypes $type
     * @param string|null $kycDocumentId
     * @return void
     */
    public function updateResume(mixed $resume): void
    {
        if ($this->resume) {
            DocumentService::delete(self::DOCUMENTS_PATH . '/' . $this->resume);
        }

        $this->resume = DocumentService::save($resume, self::DOCUMENTS_PATH);
    }



    // Delete document from disk and and set filename field of Model
    public static function deleteDocument(PortfolioContent $portfolio): void
    {
        $document = self::where(['resume' => $portfolio->resume])->first();

        if ($document) {
            DocumentService::delete(self::DOCUMENTS_PATH . '/' . $document->resume);
            $document->delete();
        }
    }

    /**
     * Get document URL.
     * 
     * @return string
     */
    public function getFile(): string
    {
        return DocumentService::fullPath(self::DOCUMENTS_PATH . '/' . $this->resume);
    }
}
