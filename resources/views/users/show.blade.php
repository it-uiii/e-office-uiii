@extends('layout.main')
@section('container')
<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <form action="/users" method="post">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" value="{{ $user->name }}" disabled>
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" value="{{ $user->email }}" disabled>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" value="{{ $user->username }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>NRP</label>
                            <input type="text" class="form-control" value="{{ $user->nrp }}" disabled>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                </div>
                <div class="form-group">
                    <label>Google email</label>
                    <input type="text" class="form-control" value="{{ $user->emailSoc }}" disabled>
                </div>
                <div class="form-group">
                    <label>Jabatan</label>
                    <input type="text" class="form-control" value="{{ $user->position }}" disabled>
                </div>
                <div class="form-group">
                    <label>Atasan</label>
                    <input type="text" class="form-control" value="{{ $user->head->name }}" disabled>
                </div>
                <div class="form-group">
                    <label>Role</label>
                    @if(!empty($user->getRoleNames()))
                        @foreach($user->getRoleNames() as $v)
                            <input type="text" class="form-control" value="{{ $v }}" disabled>
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
</div>
@endsection
