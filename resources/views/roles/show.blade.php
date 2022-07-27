@extends('layout.main')
@section('container')
    <div class="col-md-6">
    <div class="card card-primary">
        <form action="/roles" method="post">
        <div class="card-body">
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" value="{{ $role->name }}" disabled>
            </div>
            <div class="form-group">
                <label>Role : </label>
                <ul>
                    @if(!empty($rolePermissions))
                        @foreach($rolePermissions as $v)
                            <li><label class="label label-success">{{ $v->name }}</label></li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
        <div class="card-footer">
            <a class="btn btn-danger" href="/roles">Back</a>
        </div>
        </form>
    </div>
</div>
@endsection