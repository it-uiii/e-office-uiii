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
        <form action="">
            @csrf
            <div class="row">
                <div class="col-5">
                    <div class="form-group">
                        <label>NRP</label>
                        <input type="text" class="form-control" name="">
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label>Nama Pegawai</label>
                        <input type="text" class="form-control" name="">
                    </div>
                <!-- /.form-group -->
                </div>
            <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Jabatan</label>
                        <select class="form-control select2" style="width: 100%;">
                            <option selected="selected">Pilih Jabatan</option>
                            <option>Staff IT</option>
                            <option>Dekan</option>
                            <option>Staff Media</option>
                        </select>
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label>Bulanan</label>
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- /.col -->
            </div>
            <button class="btn btn-outline-primary">cari</button>
        </form>
    </div>
    <div class="card-body">
        <div class="float-right mb-2">
            <form action="">
                <a class="btn btn-outline-danger" href="" title="download-pdf">
                    <i class="fas fa-file-pdf"></i>
                </a>
            </form>
        </div>
        {{-- foreach --}}
        <h4 class="card-title">1-5 September 2022</h4>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>Tanggal</th>
                <th>Nama</th>
                <th>Keterangan</th>
                <th>status</th>
                <th>Action</ths>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td>01, Januari 2022</td>
                <td>Membuat Aplikasi Website</td>
                <td>Aplikasi yang bertujuan untuk me...</td>
                <td>
                    {{-- proses awal yaitu proses, jika proses disetujui maka bg-success, else bg-danger --}}
                    <span class="badge bg-success">Disetujuin</span>
                    <span class="badge bg-info">Proses</span>
                    <span class="badge bg-danger">Ditolak</span>
                </td>
                <td>
                    <a class="btn btn-info" href=""><i class="fas fa-eye"></i></a>
                    @can('user-edit')
                    <a class="btn btn-warning" href=""><i class="fas fa-pen"></i></a>    
                    @endcan
                    @can('user-delete')
                    <form action="" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger" onclick="return confirm('Are you sure want delete this user?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                    @endcan
                </td>
            </tr>
            </tbody>
        </table>
        {{-- end foreach --}}
    </div>

    <div class="card-body">
        <h4 class="card-title">8-12 September 2022</h4>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>Tanggal</th>
                <th>Nama</th>
                <th>Keterangan</th>
                <th>status</th>
                <th>Action</ths>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td>01, Januari 2022</td>
                <td>Membuat Aplikasi Website</td>
                <td>Aplikasi yang bertujuan untuk me...</td>
                <td>
                    {{-- proses awal yaitu proses, jika proses disetujui maka bg-success, else bg-danger --}}
                    <span class="badge bg-success">Disetujuin</span>
                    <span class="badge bg-info">Proses</span>
                    <span class="badge bg-danger">Ditolak</span>
                </td>
                <td>
                    <a class="btn btn-info" href=""><i class="fas fa-eye"></i></a>
                    @can('user-edit')
                    <a class="btn btn-warning" href=""><i class="fas fa-pen"></i></a>    
                    @endcan
                    @can('user-delete')
                    <form action="" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger" onclick="return confirm('Are you sure want delete this user?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                    @endcan
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