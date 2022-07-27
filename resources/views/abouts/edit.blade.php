
{{-- @dd($about); --}}
@extends('layout.main')
@section('container')
<div class="card card-primary">
    <form action="/abouts/{{ $about->id }}" method="post">
    @method('put')
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="quote">Quote</label>
            <input type="text" class="form-control @error('quote') is-invalid @enderror" id="quote" name="quote" value="{{ old('quote', $about->quote) }}">
            @error('quote')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="sub_quote">Sub quote</label>
            <input type="text" class="form-control @error('sub_quote') is-invalid @enderror" id="sub_quote" name="sub_quote" value="{{ old('sub_quote', $about->sub_quote) }}">
            @error('sub_quote')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="body">Body reposition</label>
            <textarea name="body" id="summernote" cols="30" rows="10">{{ old('body', $about->body) }}</textarea>
        </div>
        <div class="form-group">
            <label for="body2">body Initiative</label>
            <br>
            <textarea name="body2">{{ old('body2', $about->body2) }}</textarea>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Update</button>
        <a class="btn btn-danger" href="/abouts">Cancel</a>
    </div>
    </form>
</div>
@endsection