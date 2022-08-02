@extends('layout.main')
@section('container')
    <div class="col-md-6">
    <div class="card card-primary">
        <form action="/faqs">
        <div class="card-body">
            <div class="form-group">
                <label>Question</label>
                <input type="text" class="form-control" value="{{ $faq->question }}" disabled>
            </div>
            <div class="form-group">
                <label>Answer</label>
                <textarea cols="50" rows="5" id="summernote">
                    {{ $faq->table }}
                </textarea>
            </div>
        </div>
        <div class="card-footer">
            <a class="btn btn-danger" href="/faqs">Back</a>
        </div>
        </form>
    </div>
</div>
@endsection