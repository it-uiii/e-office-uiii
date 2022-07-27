@extends('layout.main')
@section('container')
<div class="card card-primary">
    <form action="/visi_misi/{{ $result->id }}" method="post">
    @method('put')
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="body">Visi & Misi Body</label>
            <textarea name="body" id="summernote" cols="30" rows="10">{{ old('body', $result->body) }}</textarea>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Update</button>
        <a class="btn btn-danger" href="/visi_misi">Cancel</a>
    </div>
    </form>
</div>
@endsection