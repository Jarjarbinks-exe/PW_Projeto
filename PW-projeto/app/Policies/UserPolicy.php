<?php

namespace App\Policies;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    use HandlesAuthorization;



    public function viewAny(User $user): bool
    {
        return UserService::getIsAdmin($user);
    }

    public function view(User $user): bool
    {
        return UserService::getIsAdmin($user);
    }

    public function create(User $user): bool
    {
        return UserService::getIsAdmin($user);
    }


    public function delete(User $user): bool
    {
        return UserService::getIsAdmin($user);
    }

    public function edit(User $user): bool
    {
        return UserService::getIsAdmin($user);
    }

    public function update(User $user): bool
    {
        return UserService::canUpdateUser($user) || UserService::getIsAdmin($user);
    }

}
