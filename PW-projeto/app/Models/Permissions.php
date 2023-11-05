<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    use HasFactory;

    public function documentos()
    {
        return $this->belongsTo(Document::class);
    }

    public function departamentos()
    {
        return $this->belongsTo(Department::class);
    }

    public function utilizadores()
    {
        return $this->belongsTo(User::class);
    }

}
