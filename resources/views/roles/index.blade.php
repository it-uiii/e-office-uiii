@extends('layout.main')
@section('container')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        @can('role-create')
                            <a class="btn btn-primary" href="/roles/create">Create New</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
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
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{ $roles->firstItem() + $loop->index }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>{{ $role->created_at }}</td>
                                        <td>{{ $role->updated_at }}</td>
                                        <td>
                                            <a class="btn btn-info" href="/roles/{{ $role->id }}"><i
                                                    class="fas fa-eye"></i></a>
                                            @can('role-edit')
                                                <a class="btn btn-warning" href="/roles/{{ $role->id }}/edit"><i
                                                        class="fas fa-pen"></i></a>
                                            @endcan
                                            @can('role-delete')
                                                <form action="/roles/{{ $role->id }}" method="post" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-danger"
                                                        onclick="return confirm('Are you sure want delete this role?')">
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
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    {{ $roles->links('partials.pagination') }}
                </div>
            </div>
        </div>
    </div>
@endsection
