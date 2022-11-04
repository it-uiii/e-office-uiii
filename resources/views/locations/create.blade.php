@extends('layout.main')
@section('container')
<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <form action="/locations" method="post">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Nama Lokasi</label>
                    <input type="text" class="form-control @error('lokasi') is-invalid @enderror" name="lokasi" value="{{ old('lokasi') }}" autofocus autocomplete="off">
                    @error('lokasi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Kode Lokasi</label>
                    <input type="text" class="form-control @error('kode_lokasi') is-invalid @enderror" name="kode_lokasi" placeholder="Enter kode_lokasi" value="{{ old('kode_lokasi') }}">
                    @error('kode_lokasi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Pinned Area</label>
                    <input type="text" class="form-control  @error('kordinasi') is-invalid @enderror" id="kordinasi" name="kordinasi" placeholder="Enter map name" value="{{ old('kordinasi') }}">
                    @error('kordinasi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Create</button>
                <a class="btn btn-danger" href="/locations">Cancel</a>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
