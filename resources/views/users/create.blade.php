@extends('layout.main')
@section('container')
<div class="col-md-6">
    <div class="card card-primary">
        <form action="/users" method="post">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter fullname" value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">NRP</label>
                <input type="text" class="form-control @error('nrp') is-invalid @enderror" id="nrp" name="nrp" placeholder="Enter nrp" value="{{ old('nrp') }}">
                @error('nrp')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control  @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter Email" value="{{ old('email') }}">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label>Jabatan</label>
                <select class="form-control" name="jabatan_id">
                    <option>Pilih Jabatan</option>
                    @foreach ($jabatan as $item)
                        @if (old('jabatan_id') == $item->id)
                            <option value="{{ $item->id }}" selected>{{ $item->nama }}</option>
                        @else
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Select Role</label>
                {!! Form::select('roles[]', $roles,[], array('class' => 'form-control')) !!}
                @error('roles')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Create</button>
            <a class="btn btn-danger" href="/users">Cancel</a>
        </div>
        </form>
    </div>
</div>
@endsection