<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public function utilizadores(){
        return $this->hasMany(User::class);
    }

    public function permissoes(){
        return $this->hasMany(Permissions::class);
    }
}
