{{-- @dd($data); --}}
@extends('layout.main')
@section('container')
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show col-md-7" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>    
@endif
<div class="col-md-7">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                @can('user-create')
                    <a class="btn btn-primary" href="/permissions/create">Create New</a>
                @endcan
            </div>
        </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Name</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</ths>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($permissions as $permission)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->created_at }}</td>
                        <td>{{ $permission->updated_at }}</td>
                        <td>
                            {{-- <a class="btn btn-info" href="/permissions/{{ $permission->id }}"><i class="fas fa-eye"></i></a> --}}
                            @can('user-edit')
                            <a class="btn btn-warning" href="/permissions/{{ $permission->id }}/edit"><i class="fas fa-pen"></i></a>    
                            @endcan
                            @can('user-delete')
                            <form action="/permissions/{{ $permission->id }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger" onclick="return confirm('Are you sure want delete this permission?')">
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
            {{ $permissions->links() }}  
        </div>
    </div>
</div>
@endsection