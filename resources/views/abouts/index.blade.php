{{-- @dd($data); --}}   
@extends('layout.main')
@section('container')
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>    
@endif
<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>quote</th>
                <th>Sub Quote</th>
                <th>Reposition</th>
                <th>Initiative</th>
                <th>Updated At</th>
                <th>Action</ths>
            </tr>
            </thead>
            <tbody>
            @foreach ($abouts as $about)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $about->quote }}</td>
                <td>{{ $about->sub_quote }}</td>
                <td>{!! $about->body !!}</td>
                <td>{!! $about->body2 !!}</td>
                <td>{{ $about->updated_at }}</td>
                <td>
                    @can('about-list')
                        <a class="btn btn-info" href="/abouts/{{ $about->id }}"><i class="fas fa-eye"></i></a>
                    @endcan
                    @can('about-edit')
                        <a class="btn btn-warning" href="/abouts/{{ $about->id }}/edit"><i class="fas fa-pen"></i></a>    
                    @endcan
                </td>
            </tr>  
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
@endsection