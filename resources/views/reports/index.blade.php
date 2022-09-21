{{-- @dd($data); --}}
@extends('layout.main')
@section('container')
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>    
@endif
<div class="card">
    <div class="card-header">
        <div class="card-title">
            @can('user-create')
                <a class="btn btn-primary" href="/reports/create">Create New</a>
            @endcan
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>Kegiatan</th>
                <th>Keterangan</th>
                <th>Action</ths>
            </tr>
            </thead>
            <tbody>
            @foreach ($daily as $day)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $day->name }}</td>
                <td>{{ $day->email }}</td>
                <td>{{ $day->created_at }}</td>
                <td>{{ $day->updated_at }}</td>
                <td>
                    <a class="btn btn-info" href="/users/{{ $day->id }}"><i class="fas fa-eye"></i></a>
                    @can('user-edit')
                    <a class="btn btn-warning" href="/users/{{ $day->id }}/edit"><i class="fas fa-pen"></i></a>    
                    @endcan
                    @can('user-delete')
                    <form action="/users/{{ $day->id }}" method="post" class="d-inline">
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
        {{ $daily->links() }}
    </div>
</div>
@endsection