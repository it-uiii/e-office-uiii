@extends('layout.main')
@section('container')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <a class="btn btn-primary" href="/assets/create">
                    <i class="fas fa-plus"></i>
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>No Inventory</th>
                            <th>Name Item</th>
                            <th>Gambar Item</th>
                            <th>Total item</th>
                            <th>Per Unit Measure</th>
                            <th>Merk</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $items->firstItem() + $loop->index }}</td>
                                <td>{{ $item->no_inventory }}</td>
                                <td>{{ $item->nama_barang }}</td>
                                <td>
                                    @if (empty($item->image))
                                        no image
                                    @else
                                        <img style="max-width: 100px" class="img-fluid" src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->image }}">
                                    @endif
                                </td>
                                <td>{{ $item->jumlah_item }}</td>
                                <td>{{ $item->ukuran_item }}</td>
                                <td>{{ $item->brand->nama_brand }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <a class="btn btn-info" href="/assets/{{ $item->id }}"><i class="fas fa-eye"></i></a>
                                        <a class="btn btn-warning" href="/assets/{{ $item->id }}/edit">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                    <form action="/assets/{{ $item->id }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger"
                                            onclick="return confirm('Are you sure want delete this user?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            {{ $items->links('partials.pagination') }}
        </div>
    </div>
@endsection
