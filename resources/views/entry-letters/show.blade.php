@extends('layout.main')
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('container')
<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-body">
                <div class="form-group">
                    <label for="number">Nomor Surat</label>
                    <input disabled type="text" class="form-control" id="number" name="number" placeholder="Masukkan Perihal" value="{{ $data->number }}">
                </div>
                <div class="form-group">
                    <label for="subject">Perihal</label>
                    <input disabled type="text" class="form-control" id="subject" name="subject" placeholder="Masukkan Perihal" value="{{ $data->subject }}">
                </div>
                <div class="form-group">
                    <label for="date_in">Tanggal Diterima</label>
                    <input disabled type="date" class="form-control" id="date_in" name="date_in" placeholder="" value="{{ $data->date_in }}">
                </div>
                <div class="form-group">
                    <label for="sender">Pengirim</label>
                    <input disabled type="text" class="form-control" id="sender" name="sender" placeholder="Nama Instansi" value="{{ $data->sender }}">
                </div>
                <div class="form-group">
                    <label for="disposition_id">Disposisi</label>
                    <div class="border rounded p-2" style="background-color: #e9ecef; color: #495057; min-height: 40px;" id="description" name="description">{!! $data->disposition_names->pluck('name')->join(', ') !!}</div>
                </div>
                <div class="form-group">
                    <label for="description">Keterangan</label>
                    <div class="border rounded p-2" style="background-color: #e9ecef; color: #495057;" id="description" name="description">{!! $data->description !!}</div>
                </div>
                @if ($data->revision)
                    <div class="form-group">
                        <label for="">Revision</label>
                        <textarea disabled class="form-control" id="revision_description" name="revision_description" placeholder="Masukkan Keterangan">{{ old('revision_description', $data->revision_description) }}</textarea>
                    </div>
                @endif
                <div class="form-group mt-3">
                    <a class="btn btn-outline-success" target="_blank" href="{{ asset(Storage::url($data->file)) }}" title="Download"><i class="fas fa-download"></i> Download Surat Masuk</a>
                </div>
                <div class="form-group">
                    {!! $data->display_status !!}
                </div>
            </div>
            <div class="card-footer">
                <a class="btn btn-danger" href="{{ route('entry-letters.index') }}">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
