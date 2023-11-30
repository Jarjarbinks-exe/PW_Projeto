<?php

namespace App\Services;

use App\Models\Administrator;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public static function getIsAdmin(User $user): bool {
        return Administrator::query()
            ->where('user_id', $user->id)
            ->exists();
    }

    public static function getUserPermissions(User $user) {
        return $user->permissions;
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

}
