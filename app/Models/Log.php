<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    protected $fillable = ['requested_document_id','forwarded_to', 'current_location','notes','status'];

    /**
     * Define an inverse one-to-many relationship with the RequestedDocument model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function requestedDocument()
    {
        return $this->belongsTo(RequestedDocument::class, 'requested_document_id');
    }
}