@extends('layout.main')
@section('container')
<div class="card card-info">
    <form class="form-horizontal" action="{{ route('contents.update', $data) }}" method="POST">
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
        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Image Preview</label>
            <div class="col-sm-10">
                <input type="hidden" name="oldCover" value="{{ $data->image }}">
            @if ($data->image)
                <img src="{{ asset(Storage::url($data->image)) }}" class="img-preview img-fluid mb-3 col-sm-2">
            @else
                <img class="img-preview img-fluid mb-3 col-sm-2">
            @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Upload Gambar</label>
            <div class="col-sm-10">
                <div class="custom-file">
                    {{-- <input type="file" class="custom-file-input" name="image" id="image" onchange="previewImage()"> --}}
                    <input type="file" class="custom-file-input" id="image" name="image" aria-describedby="image" aria-label="Upload" onchange="previewImage()">
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
        @permission('status-content')
        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-10">
                <select class="form-control @error('status') is-invalid @enderror" name="status">
                    <option value="" selected>Pilih</option>
                    @if ($data->status == '1')
                    <option value="1" selected>ON</option>
                    @else
                    <option value="0" selected>OFF</option>
                    @endif
                    <option value="1">ON</option>
                    <option value="0">OFF</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        @endpermission
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-warning">Update</button>
        <a href="/contents" class="btn btn-danger">Kembali</a>
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

    // script preview image
    function previewImage(){
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
@endsection
@endsection
