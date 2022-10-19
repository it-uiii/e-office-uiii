@extends('layout.main')
@section('container')
<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <form action="/users/{{ $user->id }}" method="post">
            @method('put')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">NamA</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">NRP</label>
                    <input type="text" class="form-control @error('nrp') is-invalid @enderror" id="nrp" name="nrp" placeholder="Enter nrp" value="{{ old('nrp', $user->nrp) }}">
                    @error('nrp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}">
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                </div>
                <div class="form-group">
                    <label>Role</label>
                    {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control')) !!}
                </div>
                <div class="form-group">
                    <label>Jabatan</label>
                    <select class="form-control" name="position_id">
                        <option>Pilih Jabatan</option>
                        @foreach ($positions as $item)
                            <option value="{{ $item->id }}" {{ old('position_id', $user->position_id) == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Atasan</label>
                    <select class="form-control" name="head_id">
                        <option>Pilih Atasan</option>
                        @foreach ($heads as $item)
                            <option value="{{ $item->id }}" {{ old('head_id', $user->head_id) == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                <a class="btn btn-danger" href="/users">Cancel</a>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
