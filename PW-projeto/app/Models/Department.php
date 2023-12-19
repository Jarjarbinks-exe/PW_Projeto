<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function users(){
        return $this->hasMany(User::class, 'user_id', 'department_id');
    }

    public function permissions(){
        return $this->belongsToMany(Permissions::class, 'department_permission', 'department_id', 'permission_id');
    }

}
