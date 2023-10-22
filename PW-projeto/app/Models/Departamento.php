<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    public function utilizadores(){
        return $this->hasMany(Utilizador::class);
    }

    public function permissoes(){
        return $this->hasMany(Permissoes::class);
    }
}
