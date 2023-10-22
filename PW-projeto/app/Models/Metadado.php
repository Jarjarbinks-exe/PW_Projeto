<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metadado extends Model
{
    use HasFactory;

    public function documents(){
        return $this->belongsTo(Documento::class);
    }
}
