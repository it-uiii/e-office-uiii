{{-- @dd($res); --}}
{{-- @include('livewire.location-show') --}}
@extends('layout.main')
@section('container')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                @can('user-create')
                    <a class="btn btn-primary" href="/locations/create">
                        <i class="fas fa-plus"></i>
                    </a>
                @endcan
            </div>
            <div class="float-right">
                {{-- @can('user-import')
                    <button type="button" class="btn btn-outline-success" title="Import" data-toggle="modal" data-target="#modal-import">
                        <i class="far fa-file-excel"></i>
                    </button>
                @endcan
                @can('user-export')
                    <form action="{{ route('locations.export') }}" class="d-inline" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-info" title="Export">
                            <i class="fas fa-file-export"></i>
                        </button>
                    </form>
                @endcan --}}
                <div class="input-group">
                    <form action="/employees" method="get">
                        <input type="text" class="form-control" placeholder="Cari lokasi" name="search" autocomplete="off">
                    </form>
                    <div class="input-group-append">
                        <a class="btn btn-outline-secondary" href="/locations">
                            <i class="fa-solid fa-arrows-rotate"></i>
                            Reset
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Lokasi</th>
                            <th>Kode Lokasi</th>
                            <th>Map</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($locations as $item)
                            <tr>
                                <td>{{ $locations->firstItem() + $loop->index }}</td>
                                <td>{{ $item->lokasi }}</td>
                                <td>{{ $item->kode_lokasi }}</td>
                                <td>
                                    <button class="btn btn-default location" data-toggle="modal" data-target="#modal-maps" data-id="{{ $item->id }}">
                                        <i class="fa-solid fa-map-pin"></i>
                                    </button>
                                </td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->updated_at }}</td>
                                <td>
                                    <a class="btn btn-info" href="/locations/{{ $item->id }}"><i class="fas fa-eye"></i></a>
                                    @can('location-edit')
                                        <a class="btn btn-warning" href="/locations/{{ $item->id }}/edit"><i
                                                class="fas fa-pen"></i></a>
                                    @endcan
                                    @can('location-delete')
                                        <form action="/locations/{{ $item->id }}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger"
                                                onclick="return confirm('Are you sure want delete this locations?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            {{ $locations->links('partials.pagination') }}
        </div>
    </div>
@endsection
