<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::orderBy('id')->paginate(25);
        return view('documents.index', compact('documents'));
    }

    public function create()
    {
        return view('documents.create');
    }

    public function store(Request $request)
    {
        // Criação de um novo documento
        $document = Document::create($request->all());

        // Guarda a criação do documento no histórico de revisões
        History::create([
            'document_id' => $document->id,
            'action' => 'Created',
            'user_id' => Auth::name(), //
            'created_at' => now(),
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
            'document_id' => $document->id,
            'action' => 'Updated',
            'user_name' => Auth::name(),
            'created_at' => now(),
        ]);
        return redirect()
            ->route('documents.show', ['document' => $document]);
    }

    #TODO Editar o ficheiro em si FileSystem
    public function edit(Document $document)
    {
        return view(
            'documents.edit',
            [
                'document' => $document
            ]
        );
    }

    public function destroy(Document $document)
    {
        // Guarda a eliminação do documento no histórico de revisões
        History::create([
            'document_id' => $document->id,
            'action' => 'Deleted',
            'user_name' => Auth::name(),
            'created_at' => now(),
        ]);

        // Apaga mesmo o docuemnto
        Document::destroy($document->id);
        return redirect()
            ->route('documents');
    }

    public function showHistory(Document $document)
    {
        // Busca o histórico
        $history = History::where('document_id', $document->id)->get();

        // Carrega na view o histórico
        return view('History', compact('history'));
    }
}
