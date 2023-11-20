<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\PermissionService;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function show(User $user, PermissionService $service) {

        return redirect()
            ->route('users.edit', ['data' => $service->getUnownedPermissions($user)]);
    }
}
