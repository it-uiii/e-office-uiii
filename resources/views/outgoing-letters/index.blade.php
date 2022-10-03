@extends('layout.main')
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
                            <th>Keterangan</th>
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
                                    <td>{{ $item->letter_created_by->name }}</td>
                                @endrole
                                <td>{{ $item->subject }}</td>
                                <td>{{ $item->destination }}</td>
                                <td>{{ $item->description }}</td>
                                <td>{!! $item->display_status !!}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->updated_at }}</td>
                                <td>
                                    <a class="btn btn-outline-success" target="_blank" href="{{ asset(Storage::url($item->file)) }}" title="Download"><i class="fas fa-download"></i></a>
                                    <a class="btn btn-info" href="{{ route('outgoing-letters.show', $item) }}"><i class="fas fa-eye"></i></a>
                                    @can('outgoing-letter-edit')
                                        @if (auth()->user()->hasRole('Staff') && $item->status == 0)
                                            <a class="btn btn-warning" href="{{ route('outgoing-letters.edit', $item) }}"><i class="fas fa-pen"></i></a>
                                        @endif

                                        @role("Admin|Pimpinan")
                                            <a class="btn btn-warning" href="{{ route('outgoing-letters.edit', $item) }}"><i class="fas fa-pen"></i></a>
                                        @endrole
                                    @endcan
                                    @can('outgoing-letter-delete')
                                        @if ($item->status == 0)
                                            <form action="{{ route('outgoing-letters.destroy', $item) }}" method="post"
                                                class="d-inline">
                                                @csrf @method('delete')
                                                <button class="btn btn-danger"
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
@endsection
