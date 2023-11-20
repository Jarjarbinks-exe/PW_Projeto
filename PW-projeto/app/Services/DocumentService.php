<?php
namespace App\Services;

use App\Models\Administrator;
use App\Models\Document;
use App\Models\Metadata;
use App\Models\Permissions;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DocumentService
{
    public static function getPermissionData(): Collection
    {
        return self::getMetadata();
    }

    public static function getMetadata() {
        return Metadata::all();
    }

    public static function getUnownedMetadata(Document $document) {
        return Metadata::all()->diff($document->metadata);
    }


}
