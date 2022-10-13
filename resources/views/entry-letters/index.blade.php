@extends('layout.main')
@section('container')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                @can('entry-letter-create')
                    @if (auth()->user()->position && auth()->user()->position->name == 'Pelaksana Sekretariat')
                        <a class="btn btn-primary" href="{{ route('entry-letters.create') }}">
                            <i class="fas fa-plus"></i>
                        </a>
                    @endif
                @endcan
                <form>
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" class="form-control float-right" placeholder="Search" value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Nomor Surat</th>
                            <th>Perihal</th>
                            <th>Tanggal Diterima</th>
                            <th>Pengirim</th>
                            <th>Disposisi</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td>{{ $data->firstItem() + $loop->index }}</td>
                                <td>{{ $item->number }}</td>
                                <td>{{ $item->subject }}</td>
                                <td>{{ date('d/m/Y',strtotime($item->date_in)) }}</td>
                                <td>{{ $item->sender }}</td>
                                <td>{{ $item->disposition_names->pluck('name')->join(', ') }}</td>
                                <td>{!! $item->description !!}</td>
                                <td>{!! $item->display_status !!}</td>
                                <td>
                                    <a class="btn btn-outline-success mb-1" target="_blank" href="{{ asset(Storage::url($item->file)) }}" title="Download"><i class="fas fa-download"></i></a>
                                    <a class="btn btn-info mb-1" href="{{ route('entry-letters.show', $item) }}"><i class="fas fa-eye"></i></a>
                                    @can('entry-letter-edit')
                                        @if (auth()->user()->hasRole('Admin') && auth()->user()->position && auth()->user()->position->name == 'Pelaksana Sekretariat' && $item->status == 0)
                                            <a class="mb-1 btn btn-warning" href="{{ route('entry-letters.edit', $item) }}"><i class="fas fa-pen"></i></a>
                                        @endif

                                        @if(auth()->user()->position && (auth()->user()->position->name == 'KTU Sekretaris' || auth()->user()->position->name == 'Rektor'))
                                            <a class="mb-1 btn btn-warning" href="{{ route('entry-letters.edit', $item) }}"><i class="fas fa-pen"></i></a>
                                        @endif
                                    @endcan
                                    @can('entry-letter-delete')
                                        @if ($item->status == 0)
                                            <form action="{{ route('entry-letters.destroy', $item) }}" method="post"
                                                class="d-inline">
                                                @csrf @method('delete')
                                                <button class="btn btn-danger mb-1"
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
            {{ $data->links('partials.pagination') }}
        </div>
    </div>
@endsection
