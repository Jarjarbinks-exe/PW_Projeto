<?php

namespace App\Policies;

use App\Models\Document;
use App\Models\User;
use App\Services\DocumentService;
use App\Services\UserService;
use Illuminate\Auth\Access\HandlesAuthorization;

class DocumentPolicy
{
    use HandlesAuthorization;



    /**
     * Se retornar true, pode fazer todas as ações.
     * Não pode retornar falso, senão o user não pode fazer nenhuma ação.
    **/
    public function before(User $user) {
        if(UserService::getIsAdmin($user)){
            return true;
        }
   }

    public function viewAny(User $user): bool
    {
        return UserService::hasPermission($user, 'viewAny');
    }

    #TODO adicionar departamentos
    public function view(User $user, Document $document): bool
    {

        return UserService::hasPermission($user, 'view')
            && DocumentService::hasPermission($document, 'is_viewable');
    }


    public function create(User $user): bool
    {
        return UserService::hasPermission($user, 'create', 'document');
    }


    public function delete(User $user, Document $document): bool
    {
        # Proprietário pode deletar o documento
        if($user->id == $document->user_id){
            return true;
        }

        return UserService::hasPermission($user, 'delete', 'user')
            && DocumentService::hasPermission($document, 'is_deletable', 'document');
    }

    public function update(User $user, Document $document): bool
    {
        return UserService::hasPermission($user, 'update', 'user')
            && DocumentService::hasPermission($document, 'is_updatable', 'document');
    }

}
