<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    protected $fillable = [
        'created_at',
        'updated_at',
        'author',
        'owner',
        'type',
        'document_id',
    ];

}
