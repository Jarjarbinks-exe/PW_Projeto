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

    # TODO passar para camada de serviço a função can_update
    public function update(User $user): bool
    {
        $can_update = function($user) {
            foreach ($user->permissions as $permission) {
                if ($permission == 'update') {
                    return true;
                }
            }
            return false;
        };

        return UserService::getIsAdmin($user) || $can_update;
    }

}
