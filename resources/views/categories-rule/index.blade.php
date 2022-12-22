@extends('layout.main')
@section('container')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                @permission('position-create')
                    <a class="btn btn-primary" href="{{ route('categories.create') }}">
                        <i class="fas fa-plus"></i>
                    </a>
                @endpermission
            </div>
            <div class="float-right">
                {{-- @permission('position-import')
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
                @endpermission --}}
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Category Name</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</ths>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $data->firstItem() + $loop->index }}</td>
                                <td>{{ $item->category_name }}</td>
                                <td>
                                    @if ($item->status == 1)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Passive</span>
                                    @endif
                                </td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->updated_at }}</td>
                                <td>
                                    <a class="btn btn-info" href="" data-toggle="modal" data-target="#modalShow-{{ $item->id }}"><i
                                            class="fas fa-eye"></i></a>
                                    @permission('position-edit')
                                        <a class="btn btn-warning" href="{{ route('categories.edit', $item) }}"><i
                                                class="fas fa-pen"></i></a>
                                    @endpermission
                                    @permission('position-delete')
                                        <form action="{{ route('categories.destroy', $item) }}" method="post" class="d-inline">
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
        {{-- <div class="card-footer clearfix">
            {{ $data->links('partials.pagination') }}
        </div> --}}
    </div>

@foreach ($data as $item)
{{-- show maps --}}
<div class="modal fade" id="modalShow-{{ $item->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="{{ $item->category_name }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Slug</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="{{ $item->slug }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Image</label>
                    <div class="col-sm-10">
                        <img src="{{ asset(Storage::url($item->image)) }}" class="img-fluid" style="max-width: 100px">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                    @if ($item->status == 1)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-danger">Passive</span>
                    @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Created At</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="{{ $item->created_at }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Modified At</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="{{ $item->updated_at }}" readonly>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="reset" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endforeach

@endsection
