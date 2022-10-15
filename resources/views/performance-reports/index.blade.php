@extends('layout.main')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .pdf-body {
            background-image: url('/img/loading.gif');
            background-repeat: no-repeat;
            background-position: center;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #444;
            line-height: 27px;
        }
        .select2-container .select2-selection--single {
            box-sizing: border-box;
            cursor: pointer;
            display: block;
            height: 38px;
            user-select: none;
            -webkit-user-select: none;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 35px;
            position: absolute;
            top: 1px;
            right: 1px;
            width: 20px;
        }
    </style>
@endsection
@section('container')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                @can('performance-report-create')
                    <a class="btn btn-primary" href="{{ route('performance-reports.create') }}">
                        <i class="fas fa-plus"></i>
                    </a>
                @endcan
                @can('performance-report-archive')
                    <a class="btn btn-success" href="#archiveModal" data-toggle="modal">
                        <i class="fas fa-archive"></i> Buat Arsip Laporan Kinerja
                    </a>
                @endcan
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            @if (!auth()->user()->hasRole('Staff'))
                                <th>Pegawai</th>
                            @endif
                            <th>Hari, Tanggal</th>
                            <th>Kegiatan</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</ths>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td>{{ $data->firstItem() + $loop->index }}</td>
                                @if (!auth()->user()->hasRole('Staff'))
                                    <td>{{ $item->report_created_by->name }}</td>
                                @endif
                                <td>{{ hari(date('N', strtotime($item->date))) }}, {{ tgl($item->date) }}</td>
                                <td>
                                    <ul class="pl-4">
                                        @foreach ($item->activities as $activity)
                                            <li>{{ $activity->activity }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{!! $item->display_status !!}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->updated_at }}</td>
                                <td>
                                    <button type="button" class="mb-1 btn btn-info" data-toggle="modal" data-target="#pdfModal" data-title="{{ $item->subject }}" data-url="{{ route('performance-reports.show', $item) }}">
                                        <i class="fas fa-eye"></i>
                                    </button>

                                    @can('performance-report-edit')
                                        @if (auth()->user()->hasRole('Staff') && $item->status == 0)
                                            <a class="mb-1 btn btn-warning" href="{{ route('performance-reports.edit', $item) }}"><i class="fas fa-pen"></i></a>
                                        @endif

                                        @role("Pimpinan")
                                            <a class="mb-1 btn btn-warning" href="{{ route('performance-reports.edit', $item) }}"><i class="fas fa-pen"></i></a>
                                        @endrole
                                    @endcan

                                    @can('performance-report-delete')
                                        @if ($item->status == 0)
                                            <form action="{{ route('performance-reports.destroy', $item) }}" method="post"
                                                class="d-inline">
                                                @csrf @method('delete')
                                                <button class="mb-1 btn btn-danger"
                                                    onclick="return confirm('Are you sure want delete this data?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center">Data Tidak Tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            {{ $data->links('partials.pagination') }}
        </div>
    </div>

    <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pdfModalLabel">Laporan Kinerja Harian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="pdf-body">
                        <iframe id="embed-pdf" src="" frameborder="0" width="100%" height="450px"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="archiveModal" tabindex="-1" aria-labelledby="archiveModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="archiveModalLabel">Arsip Laporan Kinerja</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formArchive" action="{{ route('performance-reports.archive') }}" method="get">
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="created_by">Pegawai</label>
                                    <select class="form-control" name="created_by" id="created_by" required></select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="date_start">Tanggal Awal</label>
                                    <input type="date" class="form-control" name="date_start" id="date_start" required>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="date_end">Tanggal Terakhir</label>
                                    <input type="date" class="form-control" name="date_end" id="date_end" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Buat Arsip</button>
                            </div>
                        </div>
                    </form>
                    <div class="pdf-body d-none mt-3">
                        <iframe id="embed-archive" src="" frameborder="0" width="100%" height="450px"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @can ('performance-report-archive')
    <script>
        $(document).ready(function() {
            $("#formArchive").submit(function(event) {
                event.preventDefault();
                let url = $(this).attr('action');
                let data = $(this).serialize();
                $("#embed-archive").attr('src', url + '?' + data);
                $(".pdf-body").removeClass('d-none');
            });
            $("#archiveModal").on('hidden.bs.modal', function() {
                $("#embed-archive").attr('src', '');
                $(".pdf-body").addClass('d-none');
            });
            $("#created_by").select2({
                placeholder: "Pilih Pegawai",
                allowClear: true,
                width: '100%',
                ajax: {
                    url: $("meta[name='base-url']").attr('content') + "/api/staff-list",
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results:  $.map(data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                },
                parent: $('#archiveModal')
            });
        });
    </script>
    @endcan
    <script>
        $(document).ready(function() {
            $('#pdfModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var url = button.data('url')
                var modal = $(this)
                modal.find('#embed-pdf').attr('src', url)
            });
        });
    </script>
@endsection
