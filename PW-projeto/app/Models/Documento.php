<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    public function metadados(){
        return $this->hasMany(Metadado::class);
    }

    public function permissoes(){
        return $this->hasMany(Permissoes::class);
    }
}
