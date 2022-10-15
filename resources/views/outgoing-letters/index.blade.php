@extends('layout.main')

@section('styles')
    <style>
        #body-pdf {
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
                @can('outgoing-letter-create')
                    <a class="btn btn-primary" href="{{ route('outgoing-letters.create') }}">
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
                            <th>Nomor Surat</th>
                            @role('Super Admin|Admin|Pimpinan')
                                <th>Staff</th>
                            @endrole
                            <th>Perihal</th>
                            <th>Tujuan</th>
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
                                <td>{{ $item->number }}</td>
                                @role('Super Admin|Admin|Pimpinan')
                                    <td>{{ $item->outgoing_created_by->name }}</td>
                                @endrole
                                <td>{{ $item->subject }}</td>
                                <td>{{ $item->destination }}</td>
                                <td>{!! $item->display_status !!}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->updated_at }}</td>
                                <td>
                                    @if (auth()->user()->position && auth()->user()->position->name == 'Rektor')
                                        <!-- Button trigger modal -->
                                        <button type="button" class="mb-1 btn btn-info" data-toggle="modal" data-target="#pdfModal" data-title="{{ $item->subject }}" data-url="{{ route('outgoing-letters.show', $item) }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    @else
                                        <a class="mb-1 btn btn-info" href="{{ route('outgoing-letters.show', $item) }}"><i class="fas fa-eye"></i></a>
                                    @endif
                                    @can('outgoing-letter-edit')
                                        @if (auth()->user()->hasRole('Staff') && $item->status == 0)
                                            <a class="mb-1 btn btn-warning" href="{{ route('outgoing-letters.edit', $item) }}"><i class="fas fa-pen"></i></a>
                                        @endif

                                        @role("Admin|Pimpinan")
                                            @if ((auth()->user()->position->name == 'Rektor' && ($item->status == 3 || $item->status == 4)) ||
                                                (auth()->user()->position->name == 'Sekretaris Universitas' && ($item->status == 2 || $item->status == 3)) ||
                                                (auth()->user()->position->name == 'KTU Sekretaris' && ($item->status == 1 || $item->status == 2)) ||
                                                (auth()->user()->position->name == 'Pelaksana Sekretariat' && ($item->status == 0 || $item->status == 1)))
                                                <a class="mb-1 btn btn-warning" href="{{ route('outgoing-letters.edit', $item) }}"><i class="fas fa-pen"></i></a>
                                            @endif
                                        @endrole
                                    @endcan
                                    @can('outgoing-letter-delete')
                                        @if ($item->status == 0)
                                            <form action="{{ route('outgoing-letters.destroy', $item) }}" method="post"
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
                    <h5 class="modal-title" id="pdfModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="body-pdf">
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
                var title = button.data('title')
                var url = button.data('url')
                var modal = $(this)
                modal.find('.modal-title').text(title)
                modal.find('#embed-pdf').attr('src', url)
            });
        });
    </script>
@endsection
