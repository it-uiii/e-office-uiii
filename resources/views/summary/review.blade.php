@extends('layout.main')
@section('container')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <label>NRP</label>
                    <input type="text" class="form-control col-10" value="12345678901234" readonly>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control col-10" value="Nur Alief Gagah Wicaksono s,Kom" readonly>
                </div>
            <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Jabatan</label>
                    <input type="text" class="form-control col-5" value="Staff IT" readonly>
                </div>
                <!-- /.form-group -->
            </div>
            <!-- /.col -->
            </div>
            <!-- /.row -->
            {{-- tanggal dari senin - jumat --}}
            <h3 class="card-title">1-5 September 2022</h3>
            <div class="card-tools">
                <div class="float-right">
                    <a class="btn btn-info" href="" title="view"><i class="fas fa-eye"></i></a>
                    <form action="" class="d-inline">
                        <button class="btn btn-danger" title="Decline"><i class="fas fa-times"></i></button>
                    </form>
                    <form action="" class="d-inline">
                        <button class="btn btn-success" title="Approve"><i class="fas fa-check"></i></button>
                    </form>
                </div>
            </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th style="width: 10px">No</th>
            <th>
                <div class="icheck-primary">
                    <input type="checkbox" value="" id="check14">
                    <label for="check14">Check All</label>
                </div>
            </th>
            <th>Tanggal</th>
            <th>Uraian Kegiatan</th>
            <th>Keterangan</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>1.</td>
            <td>
                <div class="icheck-primary">
                    <input type="checkbox" value="" id="check1">
                    <label for="chec1"></label>
                </div>
            </td>
            <td>1 September 2022</td>
            <td>Membuat Surat Undangan</td>
            <td>Membuat surat undangan untuk pimpinan</td>
            <td>
                {{-- proses awal yaitu proses, jika proses disetujui maka bg-success, else bg-danger --}}
                    <span class="badge bg-info">Proses</span>
                    <span class="badge bg-success">Disetujuin</span>
                    <span class="badge bg-danger">Ditolak</span>
            </td>
            <td>
                <a class="btn btn-info" href="" title="view"><i class="fas fa-eye"></i></a>
                <form action="" class="d-inline">
                    <button class="btn btn-danger" title="Decline"><i class="fas fa-times"></i></button>
                </form>
                <form action="" class="d-inline">
                    <button class="btn btn-success" title="Approve"><i class="fas fa-check"></i></button>
                </form>
            </td>
        </tr>
        </tbody>
    </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
        <div>
            <a class="btn btn-outline-danger" href="/report">Kembali</a>
        </div>
    <ul class="pagination pagination-sm m-0 float-right">
        <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
    </ul>
    </div>
</div>
<!-- /.card -->
@endsection