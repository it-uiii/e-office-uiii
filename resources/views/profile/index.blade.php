@extends('layout.main')
@section('container')
<div class="col-md-6">
    <div class="card card-primary">
        <form method="post">
        <div class="card-body">
            <div class="form-group">
                <label for="name">Fullname</label>
                <input type="text" class="form-control" value="{{ auth()->user()->name }}" disabled readonly>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" value="{{ auth()->user()->email }}" disabled readonly>
            </div>
            <div class="form-group">
                <label>Role : </label>
                @if(!empty($user->getRoleNames()))
                    @foreach($user->getRoleNames() as $v)
                        <input type="text" class="form-control" value="{{ $v }}" disabled readonly>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="card-footer">
            <a class="btn btn-danger" href="/">Back</a>
        </div>
        </form>
    </div>
    </div>
@endsection