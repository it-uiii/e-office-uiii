@extends('layout.main')
@section('container')
<div class="card card-primary">
    <form action="/services/{{ $service->slug }}" method="post">
    @method('put')
    @csrf
    <div class="card-body">
        <div class="form-group col-md-7">
            <label for="title">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Enter title" value="{{ old('title', $service->title) }}">
            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <input type="hidden" name="slug" value="{{ old('slug', $service->slug) }}">
        </div>
        <div class="form-group col-md-7">
            <label>Category</label>
            <select class="form-control" name="category_id">
                <option>Choose category</option>
                @foreach ($categories as $category)
                    @if (old('category_id', $service->category->id) == $category->id)
                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                    @else
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <textarea name="body" id="summernote">
                {{ old('body', $service->body) }}
            </textarea>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Update</button>
        <a class="btn btn-danger" href="/services">Cancel</a>
    </div>
    </form>
</div>
<script>
    $('#summernote').summernote({
    placeholder: 'Write something!!!',
    tabsize: 2,
    // height: 100
    });
    
    if ($('#summernote').summernote('isEmpty')) {
    alert('content cannot be empty!!');
    }
</script>
@endsection