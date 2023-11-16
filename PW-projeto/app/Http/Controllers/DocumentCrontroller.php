<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
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

    }

    public function delete(Document $document)
    {
        // Guarda a eliminação do documento no histórico de revisões
        History::create([
            'document_id' => $document->id,
            'action' => 'Deleted',
            'user_name' => Auth::name(),
            'created_at' => now(),
        ]);

        // Apaga mesmo o docuemnto
        $document->delete();


    }

    public function showHistory(Document $document)
    {
        // Busca o histórico
        $history = History::where('document_id', $document->id)->get();

        // Carrega na view o histórico
        return view('History', compact('history'));
    }
}
