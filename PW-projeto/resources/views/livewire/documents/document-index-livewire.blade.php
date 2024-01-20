
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
            <tr>
                <td colspan="3" class="text-right">
                    <a href="{{ route('documents.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus fa-fw mr-2"></i>Add Document
                    </a>
                </td>
            </tr>
            <table class="table table-striped table-hover" style="background-color: white;">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Data</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                    @foreach($documents as $document)
                        <tr>
                            <td>{{ $document->id }}</td>
                            <td>{{ $document->created_at }}</td>
                            <td>
                                @can('view', $document)
                                <a href="{{ url('/documents/'.$document->id.'/history') }}" class="btn btn-info">
                                    <i class="fa fa-info-circle fa-fw mr-2"></i>Details
                                </a>
                                @endcan
                                @if(!$document->password || session('valid_response_'.$document->id))
                                    @if($document->file_path)
                                        @can('view', $document)
                                            <a href="{{ asset('storage/' . $document->file_path) }}" class="btn btn-secondary">
                                                <i class="fa fa-eye fa-fw mr-2"></i>View
                                            </a>
                                        @endcan
                                    @endif
                                    @can('update', $document)
                                        <a href="{{ url('/documents/'.$document->id.'/edit') }}" class="btn btn-warning">
                                            <i class="fa fa-edit fa-fw mr-2"></i>Edit
                                        </a>
                                    @endcan
                                    @can('delete', $document)
                                        <form action="{{ url('/documents/'.$document->id) }}" method="post" style="display: inline;">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-trash fa-fw mr-2"></i>Delete
                                            </button>
                                        </form>
                                    @endcan
                                @else
                                    <form action="{{ route('documents.password', ['document' => $document]) }}" method="post">
                                        @csrf
                                        @method('GET')
                                        <div class="form-group">
                                            <label for="password">Password:</label>
                                            <input type="password" name="password" id="password" class="form-control" required>
                                        </div>
                                        @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <button type="submit" class="btn btn-success">
                                            <i class="fa fa-check fa-fw mr-2"></i>Confirm Password
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
