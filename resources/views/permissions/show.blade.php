@extends('layout.main')
@section('container')
    <div class="col-md-6">
    <div class="card card-primary">
        <form action="/$permissions" method="post">
        <div class="card-body">
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" value="{{ $permission->name }}" disabled>
            </div>
        </div>
        <div class="card-footer">
            <a class="btn btn-danger" href="/permissions">Back</a>
        </div>
        </form>
    </div>
</div>
@endsection