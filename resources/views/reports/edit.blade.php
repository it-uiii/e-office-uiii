@extends('layout.main')
@section('container')
<div class="col-md-6">
<div class="card card-primary">
    <form action="/users/{{ $data->id }}" method="post">
    @method('put')
    @csrf
    <div class="card-body">
        <div class="form-group row">
            <label for="kegiatan" class="col-sm-2 col-form-label">Kegiatan</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('kegiatan') is-invalid @enderror" id="kegiatan" name="kegiatan" value="{{ old('kegiatan', $data->kegiatan) }}" autofocus>
            </div>
        </div>
        <div class="form-group row">
            <label for="tanggal_dibuat" class="col-sm-2 col-form-label">Tanggal Dibuat</label>
            <div class="col-sm-10">
                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                    <input type="date" class="form-control" id="tanggal_dibuat" name="tanggal_dibuat" value="{{ $data->tanggal_dibuat->format('d M y') }}">
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="keterangan" id="keterangan" rows="3">
                    {{ old('keterangan', $data->keterangan) }}
                </textarea>
            </div>
        </div>

        
        <div class="form-group row">
            <label for="filenames" class="col-sm-2 col-form-label">Lampiran</label>
            <div class="col-sm-10">
                <div class="input-group hdtuto control-group lst increment" >
                    <input type="file" name="filenames[]" class="form-control">
                    <div class="input-group-btn"> 
                        <button class="btn btn-success" type="button"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
                <div class="clone hide">
                    <div class="hdtuto control-group lst input-group" style="margin-top:10px">
                        <input type="file" name="filenames[]" class="form-control">
                        <div class="input-group-btn"> 
                        <button class="btn btn-danger" type="button"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="keterangan" class="col-sm-2 col-form-label">Pimpinan</label>
            <div class="col-sm-10">
                <div class="form-group">
                    <select class="custom-select">
                    <option>Pilih KTU</option>
                    <option>M. Hatta</option>
                    <option>Imansari</option>
                    <option>Choirul Anwar</option>
                    <option>Megawati</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Update</button>
        <a class="btn btn-danger" href="/users">Cancel</a>
    </div>
    </form>
</div>
</div>
@endsection