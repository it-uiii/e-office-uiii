@extends('layout.main')
@section('container')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                @permission('user-create')
                    <a class="btn btn-primary" href="/users/create">
                        <i class="fas fa-plus"></i>
                    </a>
                @endpermission
            </div>
            <div class="float-right">
                @permission('user-import')
                    <button type="button" class="btn btn-outline-success" title="Import" data-toggle="modal" data-target="#modal-import">
                        <i class="far fa-file-excel"></i>
                    </button>
                @endpermission
                @permission('user-export')
                    <form action="{{ route('users.export') }}" class="d-inline" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-info" title="Export">
                            <i class="fas fa-file-export"></i>
                        </button>
                    </form>
                @endpermission
            </div>
            <div class="float-right mr-5">
                <div class="input-group">
                    <form action="/users" method="get">
                        <input type="text" class="form-control" placeholder="Search name or NIP" name="search" autocomplete="off">
                    </form>
                    <div class="input-group-append">
                        <a class="btn btn-outline-secondary" href="/users">
                            <i class="fa-solid fa-arrows-rotate"></i>
                            Reset
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>NRP</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $user)
                            <tr>
                                <td>{{ $data->firstItem() + $loop->index }}</td>
                                <td>{{ $user->nrp }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->updated_at }}</td>
                                <td>
                                    @if ($user->status == 1)
                                        <span class="badge bg-success">Active</span>
                                    @elseif ($user->status == 0)
                                        <span class="badge bg-danger">Passive</span>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-info" href="/users/{{ $user->id }}"><i class="fas fa-eye"></i></a>
                                    @permission('user-edit')
                                        <a class="btn btn-warning" href="/users/{{ $user->id }}/edit"><i
                                                class="fas fa-pen"></i></a>
                                    @endpermission
                                    @permission('user-delete')
                                        <form action="/users/{{ $user->id }}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger"
                                                onclick="return confirm('Are you sure want delete this user?')">
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
            <form action="{{ route('users.import') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Import user</h4>
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
