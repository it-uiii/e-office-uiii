@extends('layout.main')
@section('container')
<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-body">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" value="{{ $data->name }}" disabled>
                </div>
            </div>
            <div class="card-footer">
                <a class="btn btn-danger" href="{{ route('positions.index') }}">Back</a>
            </div>
        </div>
    </div>
</div>
@endsection
