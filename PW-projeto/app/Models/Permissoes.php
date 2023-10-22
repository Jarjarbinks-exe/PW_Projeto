<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissoes extends Model
{
    use HasFactory;

    public function documentos()
    {
        return $this->belongsTo(Documento::class);
    }

    public function departamentos()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function utilizadores()
    {
        return $this->belongsTo(Utilizador::class);
    }
}
