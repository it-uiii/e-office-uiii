@extends('layout.main')
@section('container')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                @permission('position-create')
                    <a class="btn btn-primary" href="{{ route('positions.create') }}">
                        <i class="fas fa-plus"></i>
                    </a>
                @endpermission
            </div>
            <div class="float-right">
                @permission('position-import')
                    <button type="button" class="btn btn-outline-success" title="Import" data-toggle="modal" data-target="#modal-import">
                        <i class="far fa-file-excel"></i>
                    </button>
                @endpermission
                @permission('position-export')
                    <form action="{{ route('positions.export') }}" class="d-inline" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-info" title="Export">
                            <i class="fas fa-file-export"></i>
                        </button>
                    </form>
                @endpermission
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Jabatan</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</ths>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $data->firstItem() + $loop->index }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->updated_at }}</td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('positions.show', $item) }}"><i
                                            class="fas fa-eye"></i></a>
                                    @permission('position-edit')
                                        <a class="btn btn-warning" href="{{ route('positions.edit', $item) }}"><i
                                                class="fas fa-pen"></i></a>
                                    @endpermission
                                    @permission('position-delete')
                                        <form action="{{ route('positions.destroy', $item) }}" method="post" class="d-inline">
                                            @csrf @method('delete')
                                            <button class="btn btn-danger"
                                                onclick="return confirm('Are you sure want delete this data?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endpermission
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            {{ $data->links('partials.pagination') }}
        </div>
    </div>

    {{-- import xlsx --}}
    <div class="modal fade" id="modal-import">
        <div class="modal-dialog">
            <form action="{{ route('positions.import') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Import jabatan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="file">File input</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input accept=".xlsx" type="file" class="custom-file-input" id="file"
                                        name="file">
                                    <label class="custom-file-label" for="file">Choose file</label>
                                </div>
                                @error('file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection
