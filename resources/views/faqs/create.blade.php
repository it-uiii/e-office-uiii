@extends('layout.main')
@section('container')
    <div class="card card-primary">
        <form action="/faqs" method="post">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label>question</label>
                <input type="text" class="form-control @error('question') is-invalid @enderror" name="question" placeholder="Enter question" value="{{ old('question') }}" autocomplete="off">
                @error('question')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label>Answer</label>
                <textarea name="table" id="summernote" cols="30" rows="10">
                </textarea>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Create</button>
        <a class="btn btn-danger" href="/faqs">Cancel</a>
    </div>
    </form>
    </div>
@endsection