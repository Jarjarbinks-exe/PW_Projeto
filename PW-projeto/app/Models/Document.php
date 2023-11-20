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
        return $this->belongsToMany(Metadata::class, 'documents_has_metadata', 'documents_id', 'metadata_id');
    }

    public function permissions(){
        return $this->belongsToMany(Permissions::class);
    }

    public function users(){
        return $this->belongsToMany(User::class, 'users_has_documents', 'documents_id', 'users_id');
    }

    public function history(){
        return $this->hasOne(History::class);
    }

    public function category(){
        return $this->hasMany(Category::class);
    }


}
