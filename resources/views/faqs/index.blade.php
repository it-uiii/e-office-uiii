{{-- @dd($faqs); --}}
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
@if (session()->has('edited'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    {{ session('edited') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>    
@endif
@if (session()->has('deleted'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('deleted') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>    
@endif
<div class="card">
    <div class="card-header">
        <div class="card-title">
            @can('service-create')
                <a class="btn btn-primary" href="/faqs/create">Create New</a>
            @endcan
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>Question</th>
                <th>Answer</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($faqs as $faq)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $faq->question }}</td>
                <td>{!! $faq->table !!}</td>
                <td>{{ $faq->created_at }}</td>
                <td>{{ $faq->updated_at }}</td>
                <td>
                    {{-- <a class="btn btn-info" href="/faqs/{{ $faq->id }}"><i class="fas fa-eye"></i></a> --}}
                    @can('faq-edit')
                    <a class="btn btn-warning" href="/faqs/{{ $faq->id }}/edit"><i class="fas fa-pen"></i></a>    
                    @endcan
                    @can('faq-delete')
                    <form action="/faqs/{{ $faq->id }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger" onclick="return confirm('Are you sure want delete this faqs?')">
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
    <!-- /.card-body -->
    <div class="card-footer clearfix">
        {{ $faqs->links() }}
    </div>
</div>
@endsection