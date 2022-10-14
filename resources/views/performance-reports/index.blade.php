@extends('layout.main')

@section('styles')
    <style>
        .modal-body {
            background-image: url('/img/loading.gif');
            background-repeat: no-repeat;
            background-position: center;
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

                                        @role("Admin|Pimpinan")
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

    <!-- Modal -->
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
                    <iframe id="embed-pdf" src="" frameborder="0" width="100%" height="450px"></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
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
