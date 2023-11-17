<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    public function metadata(){
        return $this->hasMany(Metadata::class);
    }

    public function permissions(){
        return $this->hasMany(Permissions::class);
    }

    public function user(){
        return $this->hasOne(User::class);
    }

    public function history(){
        return $this->hasOne(History::class);
    }

    public function category(){
        return $this->hasMany(Category::class);
    }


}
