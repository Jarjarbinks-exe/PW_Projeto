<?php

namespace App\Services;

use App\Models\Department;
use App\Models\User;

class DepartmentService
{

    public static function getUnownedDepartments(User $user) {
        return Department::all()->diff($user->departments);
    }


}
