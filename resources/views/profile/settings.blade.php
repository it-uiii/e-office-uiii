@extends('layout.main')
@section('container')
<div class="col-md-6">
    <div class="card card-primary">
        <form action="/profile/{{ session('user')->id }}/settings" method="post">
        @method('put')
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="old_password">Old Password</label>
                <input type="password" class="form-control @error('old_password') is-invalid @enderror" id="old_password" name="old_password" placeholder="Old Password">
                @error('old_password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <small style="color: red;">{{ session('gagal') }}</small>
            </div>
            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password" placeholder="New Password">
                @error('new_password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                @error('password_confirmation')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Change</button>
            <a class="btn btn-danger" href="/profile/{{ session('user')->id }}/index">Cancel</a>
        </div>
        </form>
    </div>
    </div>
@endsection
