{{-- @dd($data); --}}
@extends('layout.main')
@section('container')

<div class="card">
    <div class="card-header">
        <div class="card-title">
            @can('user-create')
                <a class="btn btn-primary" href="/jabatan/create">
                    <i class="fas fa-plus"></i>
                </a>
            @endcan
        </div>
        <div class="float-right">
            <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-import">
                <i class="far fa-file-excel"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
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
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->created_at }}</td>
                <td>{{ $item->updated_at }}</td>
                <td>
                    <a class="btn btn-info" href="/jabatan/{{ $item->id }}"><i class="fas fa-eye"></i></a>
                    @can('user-edit')
                    <a class="btn btn-warning" href="/jabatan/{{ $item->id }}/edit"><i class="fas fa-pen"></i></a>    
                    @endcan
                    @can('user-delete')
                    <form action="/jabatan/{{ $item->id }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger" onclick="return confirm('Are you sure want delete this user?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                    @endcan
                </td>
            </tr>  
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
        {{ $data->links() }}
    </div>
</div>

{{-- import xlsx --}}
<div class="modal fade" id="modal-import">
    <div class="modal-dialog">
        <form action="ImportJabatan" method="post">
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
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="exampleInputFile" name="file">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Import</button>
            </div>
        </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection