<?php


namespace app\Livewire\Documents;

use App\Models\Document;
use App\Services\DocumentService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class DocumentIndexLivewire extends Component
{
    use AuthorizesRequests;

    public $metadata = '';
    public $category = '';
    public $search = '';
    public $documentId = '';
    public $confirmed = false;
    public $isPageLoaded = false;
    public $selectedDocuments = [];


    public function render()
    {
        $documents = Document::query();



        if ($this->metadata != '') {
            $documents->whereHas('metadata', function ($query) {
                $query->where('metadata_id', $this->metadata);
            });
        }

        if ($this->category != '') {
            $documents->whereHas('categories', function ($query) {
                $query->where('category_id', $this->category);
            });
        }

        $documents = $documents->get();

        return view(
            'livewire.documents.document-index-livewire',
            [
                'documents' => $documents
            ]
        )->extends('layouts.autenticado')->section('main-content');
    }

    function deleteDocument(int $id)
    {
        if ($this->documentId == $id) {
            $service = new DocumentService();
            $service->deleteDocument(Document::find($id));
            $this->documentId = '';

        } else {
            $this->documentId = $id;
        }
    }


}
