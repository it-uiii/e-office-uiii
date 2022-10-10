{{-- @dd($data); --}}
@extends('layout.main')
@section('container')
<div class="card">
    <div class="card-header">
        <div class="card-title">
            <a class="btn btn-primary" href="/reports/create">
                <i class="fas fa-plus"></i>
            </a>
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
            @if ($daily->count())
            @foreach ($daily as $day)
            <tr>
                <td>{{ $daily->firstItem() + $loop->index }}</td>
                <td>
                    <div class="icheck-primary">
                        <input type="checkbox" value="" id="check1">
                        <label for="check1"></label>
                    </div>
                </td>
                <td>{{ date('d M Y', strtotime($day->tanggal_dibuat)) }}</td>
                <td>{{ $day->kegiatan }}</td>
                <td>
                    {{ Str::limit($day->keterangan, 50) }}
                </td>
                <td>
                    @if($day->status == 'Proses')
                    {{-- jika masih proses->default proses setelah create --}}
                    <span class="badge p-2 bg-info">Proses</span>
                    @elseif($day->status == 'Disetujui')
                    {{-- jika telah disetujui pimpinan --}}
                    <span class="badge p-2 bg-success">Disetujui</span>
                    @elseif($day->status == 'Dikirim')
                    {{-- jika sudah di submit -> dikirim ke summary dan diterima oleh pimpinan --}}
                    <span class="badge p-2 bg-warning">Dikirim</span>
                    @elseif($day->status == 'Ditolak')
                    {{-- jika telah ditolak pimpinan --}}
                    <span class="badge p-2 bg-danger">Ditolak</span>
                    @endif
                </td>
                <td>
                    <a class="btn btn-info" href="/reports/{{ $day->id }}"><i class="fas fa-eye"></i></a>
                    <a class="btn btn-warning" href="{{ route('reports.edit', $day) }}"><i class="fas fa-pen"></i></a>    
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
            @endforeach
            @else
            <tr>
                <td colspan="7">
                    <strong>
                        <h4 class="text-center">
                            No Reports
                        </h4>
                    </strong>
                </td>
            </tr>
            @endif
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