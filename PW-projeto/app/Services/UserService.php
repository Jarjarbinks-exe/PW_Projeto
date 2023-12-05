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
     * Verifica se o user tem a permissão, assim como o seu departamento se sim retorna True
     *
     ***/
    # TODO Nice-to-have hasPermission function passar a estar só num lugar e receber um objeto verificar se ele tem permissiões
    public static function hasPermission(User $user, string $value, ?string $type=null): bool {

        # Verifica se o departamento tem a permissão
        if($user->departments){
            foreach ($user->departments as $department) {
                if($type === null) {
                    foreach($department->permissions as $permission){
                        if ($permission->value === $value) {
                            return true;
                        }
                    }
                }
                else {
                    foreach ($department->permissions as $permission){
                        if ($permission->value === $value &&  $permission->type === $type) {
                            return true;
                        }
                    }
                }
            }
        }

        # Verifica se o User tem a permissão
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
    # TODO substituir pela hasPermission...
    public static function canUpdateUser(User $user) {
        foreach ($user->permissions as $permission) {
            if ($permission->value === 'update' && $permission->type === 'user') {
                return true;
            }
        }
        return false;
    }


}
