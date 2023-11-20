<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metadata extends Model
{
    use HasFactory;

    public function documents(){
        return $this->belongsToMany(Document::class, 'documents_has_metadata', 'metadata_id', 'documents_id');
    }
}
