@extends('layout.main')
@section('container')
    <div class="card card-primary">
        <form action="/category/{{ $category->id }}" method="post">
        @method('put')
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Category Name</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="name" name="name" value="{{ old('name', $category->name) }}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update</button>
            <a class="btn btn-danger" href="/category">Cancel</a>
        </div>
        </form>
    </div>
{{-- <script>
    const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');

    title = addEventListener('change', function(){
        fetch('/category/checkSlug?title=' + name.value)
        .then(response => response.json())
        .then(data => slug.value = data.slug)
    });   
</script> --}}
@endsection