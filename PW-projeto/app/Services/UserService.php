<?php

namespace App\Services;

use App\Models\Administrator;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Dto\UserDTO;

class UserService
{
    public static function getIsAdmin(User|Authenticatable $user): bool {
        return Administrator::query()
            ->where('user_id', $user->id)
            ->exists();
    }

    /***
     * Verifica se o user tem a permissão, se sim retorna True
     *
     ***/
    public static function hasPermission(User $user, string $value, ?string $type=null): bool {

        if($type === null){
            foreach ($user->permissions as $permission) {
                if ($permission->value === $value) {
                    return true;
                }
            }
        }
        else{
            foreach ($user->permissions as $permission) {
                if ($permission->value === $value &&  $permission->type === $type) {
                    return true;
                }
            }
        }
        return false;
    }

    public static function createUser(UserDTO $userDTO)
    {
        $user = User::create($userDTO->toArray());

        return $user;
    }

    public static function updateUser(User $user, UserDTO $userDTO)
    {
        $user = User::update($userDTO->toArray());

        return $user;
    }

    /**
     * Se tiver a permissão de update para o tipo user retorna true
    */
    public static function canUpdateUser(User $user) {
        foreach ($user->permissions as $permission) {
            if ($permission->value === 'update' && $permission->type === 'user') {
                return true;
            }
        }
        return false;
    }


}
