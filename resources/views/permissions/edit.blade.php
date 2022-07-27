@extends('layout.main')
@section('container')
<div class="col-md-6">
    <div class="card card-primary">
        <form action="/permissions/{{ $permission->id }}" method="post">
        @method('put')
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $permission->name) }}">
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update</button>
            <a class="btn btn-danger" href="/permissions">Cancel</a>
        </div>
        </form>
    </div>
</div>
@endsection