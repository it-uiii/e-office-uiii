@extends('layout.main')
@section('container')
<div class="card card-primary">
    <form action="/faqs/{{ $faq->id }}" method="post">
    @method('put')
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="question">Question</label>
            <input type="text" class="form-control @error('question') is-invalid @enderror" id="question" name="question" placeholder="Enter question" value="{{ old('question', $faq->question) }}">
            @error('question')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="table">Answer</label>
            <textarea name="table" id="summernote">
                {{ old('table', $faq->table) }}
            </textarea>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Update</button>
        <a class="btn btn-danger" href="/faqs">Cancel</a>
    </div>
    </form>
</div>
<script>
@endsection