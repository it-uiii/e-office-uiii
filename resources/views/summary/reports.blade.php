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
    <div class="card-body">
        <table class="table table-bordered text-center">
            <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>NRP</th>
                <th>Nama</th>
                <th>status</th>
                <th>Action</ths>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td>12345678901234</td>
                <td>Gagah</td>
                <td>
                    {{-- proses awal yaitu proses, jika proses disetujui maka bg-success, else bg-danger --}}
                    <span class="badge bg-info">Proses</span>
                    <span class="badge bg-success">Disetujuin</span>
                    <span class="badge bg-danger">Ditolak</span>
                </td>
                <td>
                    <a class="btn btn-info" href="/review" title="review"><i class="fas fa-eye"></i></a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
        {{ $reports->links() }}
    </div>
</div>
@endsection