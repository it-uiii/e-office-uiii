@extends('layout.main')
@section('container')
    <div class="card card-primary">
        <form action="/services" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Enter title" value="{{ old('title') }}">
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            {{-- <div class="form-group">
                <input type="text" class="form-control" name="slug" readonly>
            </div> --}}
            <div class="form-group">
                <label>Category</label>
                <select class="form-control" name="category_id">
                    <option>Choose category</option>
                    @foreach ($categories as $category)
                        @if (old('category_id') == $category->id)
                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                        @else
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="cover">Upload cover</label>
                <img class="img-preview img-fluid mb-3 col-sm-2">
                <div class="input-group">
                    <div class="custom-file">
                        <input class="form-control @error('cover') @enderror" type="file" name="cover" id="cover" onchange="previewImage()">
                        @error('cover')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                @error('body')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <textarea name="body" id="summernote" cols="30" rows="10">
                </textarea>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Create</button>
            <a class="btn btn-danger" href="/services">Cancel</a>
        </div>
        </form>
    </div>
<script>
    // const title = document.querySelector('#title');
    // const slug = document.querySelector('#slug');

    // title = addEventListener('change', function(){
    //     fetch('/services/checkSlug?title=' + title.value)
    //     .then(response => response.json())
    //     .then(data => slug.value = data.slug)
    // });

    // script preview image
    function previewImage(){
        const cover = document.querySelector('#cover');
        const imgPreview = document.querySelector('.img-preview');


        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(cover.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
    
</script>
@endsection