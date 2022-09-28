{{-- @dd($data); --}}
@extends('layout.main')
@section('container')
<div class="card">
    <div class="card-header">
        <div class="card-title">
            @can('user-create')
                <a class="btn btn-primary" href="/reports/create">
                    <i class="fas fa-plus"></i>
                </a>
            @endcan
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="text-center" style="width: 10px" colspan="2">No.</th>
                <th>Tanggal</th>
                <th>Kegiatan</th>
                <th>Keterangan</th>
                <th>Status</th>
                <th>Action</ths>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td>
                    <div class="icheck-primary">
                        <input type="checkbox" value="" id="check1">
                        <label for="check1"></label>
                    </div>
                </td>
                <td>01 Januari 2022</td>
                <td>Membuat Website</td>
                <td>mengembangkan website sesuai kebutuhan divisi o...</td>
                <td>
                    {{-- jika telah disetujui pimpinan --}}
                    <span class="badge p-2 bg-success">Disetujui</span>
                    {{-- jika masih proses->default proses setelah create --}}
                    <span class="badge p-2 bg-info">Proses</span>
                    {{-- jika sudah di submit -> dikirim ke summary dan diterima oleh pimpinan --}}
                    <span class="badge p-2 bg-warning">Dikirim</span>
                    {{-- jika telah ditolak pimpinan --}}
                    <span class="badge p-2 bg-danger">Ditolak</span>
                </td>
                <td>
                    <a class="btn btn-info" href=""><i class="fas fa-eye"></i></a>
                    <a class="btn btn-warning" href=""><i class="fas fa-pen"></i></a>    
                    <form action="" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger" onclick="return confirm('Are you sure want delete this user?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                    <a class="btn btn-secondary" href=""><i class="fas fa-file-pdf"></i></a>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>
                    <div class="icheck-primary">
                        <input type="checkbox" value="" id="check2">
                        <label for="check2"></label>
                    </div>
                </td>
                <td>01 Januari 2022</td>
                <td>Membuat Website</td>
                <td>mengembangkan website sesuai kebutuhan divisi o...</td>
                <td>
                    {{-- jika telah disetujui pimpinan --}}
                    <span class="badge p-2 bg-success">Disetujui</span>
                    {{-- jika masih proses->default proses setelah create --}}
                    <span class="badge p-2 bg-info">Proses</span>
                    {{-- jika sudah di submit -> dikirim ke summary dan diterima oleh pimpinan --}}
                    <span class="badge p-2 bg-warning">Dikirim</span>
                    {{-- jika telah ditolak pimpinan --}}
                    <span class="badge p-2 bg-danger">Ditolak</span>
                </td>
                <td>
                    <a class="btn btn-info" href=""><i class="fas fa-eye"></i></a>
                    <a class="btn btn-warning" href=""><i class="fas fa-pen"></i></a>    
                    <form action="" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger" onclick="return confirm('Are you sure want delete this user?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                    <a class="btn btn-secondary" href=""><i class="fas fa-file-pdf"></i></a>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>
                    <div class="icheck-primary">
                        <input type="checkbox" value="" id="check3">
                        <label for="check3"></label>
                    </div>
                </td>
                <td>02 Januari 2022</td>
                <td>Meeting dengan vendor</td>
                <td>bertemu dengan vendor pt. xxxxxx untuk pengarahan apli...</td>
                <td>
                    {{-- jika telah disetujui pimpinan --}}
                    <span class="badge p-2 bg-success">Disetujui</span>
                    {{-- jika masih proses->default proses setelah create --}}
                    <span class="badge p-2 bg-info">Proses</span>
                    {{-- jika sudah di submit -> dikirim ke summary dan diterima oleh pimpinan --}}
                    <span class="badge p-2 bg-warning">Dikirim</span>
                    {{-- jika telah ditolak pimpinan --}}
                    <span class="badge p-2 bg-danger">Ditolak</span>
                </td>
                <td>
                    <a class="btn btn-info" href=""><i class="fas fa-eye"></i></a>
                    <a class="btn btn-warning" href=""><i class="fas fa-pen"></i></a>    
                    <form action="" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger" onclick="return confirm('Are you sure want delete this user?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                    <a class="btn btn-secondary" href=""><i class="fas fa-file-pdf"></i></a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
        {{ $daily->links() }}
        <div class="float-right">
        <form action="" method="post">
            @csrf
            <button class="btn btn-success">
                <i class="fas fa-paper-plane"></i>
            </button>
        </form>
    </div>
    </div>
</div>
@endsection