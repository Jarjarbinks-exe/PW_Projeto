<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\History;
use App\Models\Metadata;
use App\Models\User;
use App\Services\DocumentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Comment\Doc;

class DocumentController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Document::class, 'document');
    }


    # TODO Só os Documentos com a permissão is_viewable devem ser paginados para um user que não seja admin, método já está implementado no DocService
    public function index()
    {
        $documents = Document::orderBy('id')->paginate(25);
        return view('documents.index', compact('documents'));
    }

    public function create()
    {
        return view('documents.create');
    }

    public function upload(Request $request, DocumentService $service)
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

            return redirect()->route('documents.create', ['document' => $document]);
        }

    }

    public function store(Request $request)
    {
        // Criação de um novo documento
        $document = Document::create($request->all());

        // Guarda a criação do documento no histórico de revisões
        History::create([
            'created_at' => now(),
            'updated_at' => now(),
            'author' => '',
            'owner' => Auth::user()->username,
            'type' => 'Deleted',
            'document_id' => $document->id,
        ]);


    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        return view('documents.show', compact('document'));
    }

    public function update(Request $request, Document $document)
    {
        // Atualização do documento
        $document->update($request->all());

        // Guarda a alteração no histórico de revisões
        History::create([
            'created_at' => now(),
            'updated_at' => now(),
            'author' => '',
            'owner' => Auth::user()->username,
            'type' => 'Deleted',
            'document_id' => $document->id
        ]);

        return redirect()
            ->route('documents.show', ['document' => $document]);
    }

    #TODO Editar o ficheiro em si FileSystem
    public function edit(Request $request, Document $document)
    {
        //$this->authorize();
        return view(
            'documents.edit',
            [
                'document' => $document
            ]
        );
    }
    # TODO FIX author, Quando apaga um Documento verificar se existe file_path, se sim apagar o documento no sistema
    public function destroy(Document $document)
    {
        // Guarda a eliminação do documento no histórico de revisões
        History::create([
            'created_at' => now(),
            'updated_at' => now(),
            'author' => '',
            'owner' => Auth::user()->username,
            'type' => 'Deleted',
            'document_id' => $document->id,
        ]);

        // Apaga mesmo o docuemnto
        Document::destroy($document->id);
        return redirect()
            ->route('documents.index');
    }

    public function showHistory(Document $document)
    {
        $this->authorize('view', $document);

        // Busca o histórico
        $history = History::where('document_id', $document->id)->get();

        // Carrega na view o histórico
        return view('history.history', compact('history'));
    }

    public function createMetadata(Document $document, Metadata $metadata) {
        $document->metadata()->attach($metadata->id);
        return redirect()
            ->route('documents.edit', compact('document'));
    }

    public function removeMetadata(Document $document, Metadata $metadata) {
        $document->metadata()->detach($metadata->id);
        return redirect()
            ->route('documents.edit', compact('document'));
    }


}
