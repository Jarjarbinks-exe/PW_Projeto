<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    public function metadados(){
        return $this->hasMany(Metadata::class);
    }

    public function permissoes(){
        return $this->hasMany(Permissions::class);
    }

    public function utilizador(){
        return $this->hasOne(User::class);
    }

    public function history(){
        return $this->hasOne(History::class);
    }

    public function category(){
        return $this->hasMany(Category::class);
    }


}
