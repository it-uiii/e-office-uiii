@extends('layout.main')
@section('container')
<div class="col-md-6">
    <div class="card card-primary">
        <form action="/jabatan" method="post">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Example: Staff Edukasi" value="{{ old('nama') }}">
                @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Create</button>
            <a class="btn btn-danger" href="/jabatan">Cancel</a>
        </div>
        </form>
    </div>
</div>
@endsection