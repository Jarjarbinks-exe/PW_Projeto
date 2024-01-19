<?php

namespace App\Http\Controllers\Api;

use App\Dto\DocumentDTO;
use App\Http\Controllers\Controller;
use App\Http\Resources\DocumentResource;
use App\Http\Resources\DocumentResourceCollection;
use App\Http\Resources\UserResourceCollection;
use App\Models\Document;
use App\Models\History;
use App\Services\DocumentService;
use http\Env\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::user()->tokenCan('documents:list')) {
            abort(403);
        }

        return new DocumentResourceCollection(Document::paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$requestData = $request->only(['user_id', 'file_path']);
        if (!Auth::user()->tokenCan('documents:create')) {
            abort(403);
        }

        // Create the document
        $document = Document::create([
            'user_id' => $request->input('user_id'),
            'file_path' => $request->input('file_path'),
        ]);

        History::create([
            'created_at' => now(),
            'updated_at' => now(),
            'owner' => Auth::user()->username,
            'type' => 'Deleted',
            'document_id' => $document->id,
        ]);

        return new DocumentResource($document);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Document $document)
    {

        if (!Auth::user()->tokenCan('documents:show')) {
            abort(403);
        }

        try {
            $document = Document::findOrFail($document->id);
            return new DocumentResource($document);
        } catch (\Exception $e) {
            if ($e instanceof ModelNotFoundException) {
                return response()->json(['message' => 'Não encontrado'], 404);
            }
            return response()->json(['message' => 'Ocorreu um erro de comunicação'], 503);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document $document)
    {

        if (!Auth::user()->tokenCan('documents:update')) {
            abort(403);
        }
        try {
            $document = Document::findOrFail($document->id);
            $documentDTO = new DocumentDTO(Auth::id(), $request['file_path']);
            $document->update($documentDTO->toArray());

            History::create([
                'created_at' => now(),
                'updated_at' => now(),
                'owner' => Auth::user()->username,
                'type' => 'Updated',
                'document_id' => $document->id
            ]);

            return new DocumentResource($document);
        } catch (\Exception $e) {
            if ($e instanceof ModelNotFoundException) {
                return response()->json(['message' => 'Não encontrado'], 404);
            }

            return response()->json(['message' => 'Ocorreu um erro de comunicação', 503]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        if (!Auth::user()->tokenCan('documents:destroy')) {
            abort(403);
        }

        try {
            $document = Document::findOrFail($document->id);

            // Guarda a eliminação do documento no histórico de revisões
            History::create([
                'created_at' => now(),
                'updated_at' => now(),
                'owner' => Auth::user()->username,
                'type' => 'Deleted',
                'document_id' => $document->id,
            ]);

            // Apaga mesmo o documento
            $document->delete();

            // You can return a success response or an empty response
            return response()->json(['message' => 'Documento destruído com sucesso' . $document->id]);
        } catch (\Exception $e) {
            if ($e instanceof ModelNotFoundException) {
                return response()->json(['message' => 'Não encontrado'], 404);
            }

            return response()->json(['message' => 'Ocorreu um erro de comunicação'], 503);
        }

    }



}

