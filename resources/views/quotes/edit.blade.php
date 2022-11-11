@extends('layout.main')
@section('container')
<div class="card card-info">
    <form class="form-horizontal" action="{{ route('quotes.update', $data) }}" method="POST">
    @method('put')
    @csrf
    <div class="card-body">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Your quote</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" autofocus autocomplete="off" value="{{ old('title', $data->title) }}">
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Deskripsi</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="body" name="body">
                    {!! old('body', $data->body) !!}
                </textarea>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-warning">Update</button>
        <a href="/quotes" class="btn btn-danger">Kembali</a>
    </div>
    </form>
</div>
@section('scripts')
<script>
    $(document).ready(function() {
        $("#body").summernote({
            height: 200,
            placeholder: 'Masukkan Deskripsi',
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']],
            ],
        });
    });
</script>
@endsection
@endsection