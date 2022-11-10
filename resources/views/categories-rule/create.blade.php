@extends('layout.main')
@section('container')
<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Category Name</label>
                        <input type="text" class="form-control @error('category_name') is-invalid @enderror" id="category_name" name="category_name" placeholder="" value="{{ old('category_name') }}">
                        @error('category_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Status</label>
                        <select class="form-control @error('status') is-invalid @enderror" name="status">
                            <option value="">Pilih Status</option>
                            <option value="1">Active</option>
                            <option value="0">Passive</option>
                        </select>
                        @error('category_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                    <label for="" class="col-form-label">Upload Image</label>
                    <div class="col-sm-10">
                        <img class="img-preview img-fluid mb-2">
                    </div>
                    <div class="custom-file">
                        {{-- <input type="file" class="custom-file-input" name="image" id="image" onchange="previewImage()"> --}}
                        <input type="file" multiple class="custom-file-input" id="image" name="image" aria-describedby="image" aria-label="Upload" onchange="previewImage()">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a class="btn btn-danger" href="{{ route('categories.index') }}">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
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
