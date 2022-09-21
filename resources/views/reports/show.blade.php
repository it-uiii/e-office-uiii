@extends('layout.main')
@section('container')
    <div class="col-md-6">
    <div class="card card-primary">
        <form action="/users" method="post">
        <div class="card-body">
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" value="{{ $user->name }}" disabled>
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" value="{{ $user->username }}" disabled>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" value="{{ $user->email }}" disabled>
            </div>
            <div class="form-group">
                <label>Role : </label>
                @if(!empty($user->getRoleNames()))
                    @foreach($user->getRoleNames() as $v)
                        <label class="badge badge-success">{{ $v }}</label>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="card-footer">
            <a class="btn btn-danger" href="/users">Back</a>
        </div>
        </form>
    </div>
</div>
@endsection