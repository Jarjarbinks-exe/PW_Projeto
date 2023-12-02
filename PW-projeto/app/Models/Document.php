<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_at',
        'updated_at',
        'user_id',
        'file_path'
    ];

    public function metadata(){
        return $this->belongsToMany(Metadata::class, 'document_metadata', 'document_id', 'metadata_id');
    }

    public function permissions(){
        return $this->belongsToMany(Permissions::class, 'document_permission', 'document_id', 'permission_id');
    }

    public function users(){
        return $this->belongsToMany(User::class, 'user_document', 'document_id', 'user_id');
    }

    public function history(){
        return $this->hasOne(History::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class, 'document_category', 'document_id', 'category_id');
    }


}
