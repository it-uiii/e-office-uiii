@extends('layout.main')
@section('container')
<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <form action="{{ route('assets.update', $data) }}" method="post">
                @method('put')
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" class="form-control @error('category_name') is-invalid @enderror" id="category_name" name="category_name" value="{{ old('category_name', $data->category_name) }}">
                        @error('category_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Status</label>
                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                            <option value="{{ $data->status }}" selected>
                            @if ($data->status == 1)
                                Active
                            @else
                                Passive
                            @endif
                            </option>
                            <option value="">Pilih Status</option>
                            <option value="1">Active</option>
                            <option value="0">Passive</option>
                        </select>
                        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>Image Preview</label>
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
                        <label>Upload Image</label>
                        <div class="col-sm-10">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image" onchange="previewImage()">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-warning">Update</button>
                    <a class="btn btn-danger" href="{{ route('categories.index') }}">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
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
