<?php
namespace App\Services;

use App\Models\Administrator;
use App\Models\Document;
use App\Models\Permissions;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PermissionService
{
    public static function getPermissionData(User $user): Collection
    {
        return self::getUnownedPermissions($user);

    }

    public static function getUnownedPermissions(User $user) {

        return Permissions::all()->where('type', '=', 'user')->diff($user->permissions);
    }

    public static function getUnownedDocumentPermissions(Document $document) {
        return Permissions::all()->where('type', '=', 'document')->diff($document->permissions);
    }

}
