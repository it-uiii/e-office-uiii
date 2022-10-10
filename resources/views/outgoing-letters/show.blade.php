@extends('layout.main')
@section('container')
<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-body">
                <div class="form-group">
                    <label for="subject">Perihal</label>
                    <input disabled type="text" class="form-control" id="subject" name="subject" placeholder="Masukkan Perihal" value="{{ old('subject', $data->subject) }}">
                </div>
                <div class="form-group">
                    <label for="date">Tanggal Surat</label>
                    <input disabled type="date" class="form-control" id="date" name="date" placeholder="" value="{{ old('date', $data->date) }}">
                </div>
                <div class="form-group">
                    <label for="destination">Tujuan</label>
                    <input disabled type="text" class="form-control" id="destination" name="destination" placeholder="Masukkan Tujuan" value="{{ old('destination', $data->destination) }}">
                </div>
                <div class="form-group">
                    <label for="description">Keterangan</label>
                    <textarea disabled type="text" class="form-control" id="description" name="description" placeholder="Masukkan Keterangan">{{ old('description', $data->description) }}</textarea>
                </div>
                <div class="form-group">
                    <a class="btn btn-outline-success" target="_blank" href="{{ asset(Storage::url($data->file)) }}" title="Download"><i class="fas fa-download"></i> Download Surat Keluar</a>
                </div>
                <div class="form-group">
                    {!! $data->display_status !!}
                </div>
                @if ($data->revision)
                    <div class="form-group">Revision</div>
                    <textarea disabled type="text" class="form-control" id="revision_description" name="revision_description" placeholder="Masukkan Keterangan">{{ old('revision_description', $data->revision_description) }}</textarea>
                @endif
            </div>
            <div class="card-footer">
                <a class="btn btn-danger" href="{{ route('outgoing-letters.index') }}">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
