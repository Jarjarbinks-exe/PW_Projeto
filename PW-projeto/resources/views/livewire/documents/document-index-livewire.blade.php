<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="metadata" class="lead">Metadata</label>
                <select wire:model.live="metadata" class="form-control" name="metadata" id="metadata">
                    <option value=""></option>
                    <option value="1">metadado1</option>
                    <option value="2">metadado2</option>
                    <option value="3">metadado3</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="category" class="lead">Category</label>
                <select wire:model.live="category" class="form-control" name="category" id="category">
                    <option value=""></option>
                    <option value="1">category1</option>
                    <option value="2">category2</option>
                    <option value="3">category3</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col">
            <table class="table table-striped table-hover" style="background-color: white;">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Data</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @can('create', \App\Models\User::class)
                    <tr>
                        <td colspan="3" class="text-right">
                            <a href="{{ route('documents.create') }}" class="btn btn-primary">
                                <i class="fa fa-plus fa-fw mr-2"></i>Add Document
                            </a>
                        </td>
                    </tr>
                @endcan

                @foreach($documents as $document)
                    <tr>
                        <td>{{ $document->id }}</td>
                        <td>{{ $document->created_at }}</td>
                        <td>
                            <a href="{{ url('/documents/'.$document->id.'/history') }}" class="btn btn-info">Details</a>
                            <a href="{{ url('/documents/'.$document->id.'/edit') }}" class="btn btn-warning">Edit</a>
                            <form action="{{ url('/documents/'.$document->id) }}" method="post" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- $users->links('pagination::bootstrap-4') --}}
</div>
