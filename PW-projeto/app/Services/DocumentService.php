<?php
namespace App\Services;

use App\Models\Administrator;
use App\Models\Document;
use App\Models\Metadata;
use App\Models\History;
use App\Models\Permissions;
use App\Models\User;
use Illuminate\Http\Request;
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

    public static function getDocumentPermissions(Document $document) {
        return $document->permissions;

    }

    public static function getViewableDocuments() {
        return Document::all()->permissions->value == 'is_viewable';
    }


    /***
     * Verifica se o Documento tem a permissão, se sim retorna True
     *
     ***/
    public static function hasPermission(Document $document, string $value, ?string $type=null): bool {

        if($type === null){
            foreach ($document->permissions as $permission) {
                if ($permission->value === $value) {
                    return true;
                }
            }
        }
        else{
            foreach ($document->permissions as $permission) {
                if ($permission->value === $value &&  $permission->type === $type) {
                    return true;
                }
            }
        }
        return false;
    }

    public static function uploadDocument(Request $request)
    {
        $path = $request->file('document')->store('local');

        $user = Auth::user();

        if ($user) {
            $document = Document::create([
                'created_at' => now(),
                'updated_at' => now(),
                'user_id' => $user->id,
                'file_path' => $path
            ]);

            $document->users()->attach($user->id);

            History::create([
                'created_at' => now(),
                'updated_at' => now(),
                'author' => '',
                'owner' => $user->username,
                'type' => 'Deleted',
                'document_id' => $document->id
            ]);

            if ($request->has('metadata_types')) {
                $document->metadata()->attach($request->input('metadata_types'));
            }

        }
    }

}
