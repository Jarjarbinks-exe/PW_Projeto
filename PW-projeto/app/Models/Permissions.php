<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    use HasFactory;

    public function documents()
    {
        return $this->belongsTo(Document::class);
    }

    public function departaments()
    {
        return $this->belongsTo(Department::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

}
