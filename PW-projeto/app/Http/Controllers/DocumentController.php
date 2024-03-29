<?php

namespace App\Http\Controllers;

use App\Dto\DocumentDTO;
use App\Mail\URLSender;
use App\Models\Category;
use App\Models\Department;
use App\Models\Document;
use App\Models\History;
use App\Models\Metadata;
use App\Models\Permissions;
use App\Models\User;
use App\Services\DocumentService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use PhpParser\Comment\Doc;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DocumentController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Document::class, 'document');
    }


    public function index(DocumentService $service)
    {
        if(UserService::getIsAdmin(Auth::getUser())){
            $documents = Document::orderBy('id')->paginate(25);
        }
        else {
            $documents = $service->getViewableDocuments();
        }
        return view('documents.index', compact('documents'));
    }

    public function create()
    {
        return view('documents.create');
    }

    # TODO user consegue definir se quer o ficheiro como privately stored no back-end
    public function upload(Request $request, DocumentService $service)
    {
        $file_path = $request->file('document')->store('files','public');
        $documentDTO = new DocumentDTO(Auth::id(), $file_path,  $request["password_fill"]);
        $document = $service->uploadDocument($documentDTO, $request);
        return redirect()->route('documents.create', ['document' => $document]);
    }

    public function download(Document $document) {

        if (Storage::disk('public')->exists($document->file_path)) {
            return Storage::disk('public')->download($document->file_path);
        }
        abort(404, 'File not Found');
    }

    public function store(Request $request)
    {
        $documentDTO = new DocumentDTO(Auth::id(), $request->file('file_path'));
        $document = Document::create($documentDTO->toArray());

        // Guarda a criação do documento no histórico de revisões
        DocumentService::createHistoryCreated($document);

    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        return view('documents.show', compact('document'));
    }

    #TODO se restar tempo, um user pode mudar a password do seu documento...
    public function update(Request $request, Document $document)
    {
        $documentDTO = new DocumentDTO(Auth::id(), $request->file('file_path'));

        $document->update($documentDTO->toArray());

        // Atualização do documento
        //$document->update($request->all());

        // Guarda a alteração no histórico de revisões
        DocumentService::createHistoryModified($document);

        return redirect()
            ->route('documents.show', ['document' => $document]);
    }

    public function edit(Request $request, Document $document)
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
        DocumentService::createHistoryDeleted($document);

        DocumentService::destroy_file($document);

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
        DocumentService::createHistoryModified($document);
        return redirect()
            ->route('documents.edit', compact('document'));
    }

    public function createCategory(Document $document, Category $category) {
        $document->categories()->attach($category->id);
        DocumentService::createHistoryModified($document);
        return redirect()
            ->route('documents.edit', compact('document'));
    }
    public function removeMetadata(Document $document, Metadata $metadata) {
        $document->metadata()->detach($metadata->id);
        DocumentService::createHistoryModified($document);
        return redirect()
            ->route('documents.edit', compact('document'));
    }

    public function removeCategory(Document $document, Category $category) {
        $document->categories()->detach($category->id);
        DocumentService::createHistoryModified($document);
        return redirect()
            ->route('documents.edit', compact('document'));
    }
    public function createPermission(Document $document, Permissions $permission) {
        $document->permissions()->attach($permission->id);
        DocumentService::createHistoryModified($document);
        return redirect()
            ->route('documents.edit', compact('document'));
    }

    public function removePermission(Document $document, Permissions $permission) {
        $document->permissions()->detach($permission->id);
        DocumentService::createHistoryModified($document);
        return redirect()
            ->route('documents.edit', compact('document'));
    }

    public function sendEmail(Document $document) {
        Mail::to(Auth::user())->send(new URLSender(Auth::user(),$document));
        return redirect()
            ->route('documents.edit', compact('document'));
    }

    public function password(Request $request, Document $document) {

        $userInputPassword = $request['password'];

        if (password_verify($userInputPassword, $document->password)) {
            session()->flash('valid_response' . $document->id, true);
        } else {
            session()->flash('invalid_response' . $document->id, false);
        }

        return redirect()->route('documents.index');
    }

}
