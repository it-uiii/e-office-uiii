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
                    <label for="date_letters">Tanggal Surat</label>
                    <input disabled type="date" class="form-control" id="date_letters" name="date_letters" placeholder="" value="{{ $data->date_letters }}">
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
                    <select disabled multiple class="form-control" id="disposition_id" name="disposition_id[]">
                        @foreach ($data->dispositions as $item)
                            <option value="{{ $item->user_id }}" selected>{{ $item->user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Keterangan</label>
                    <textarea disabled type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Masukkan Keterangan">{{ $data->description }}</textarea>
                </div>
                <div class="form-group">
                    <a class="btn btn-outline-success" target="_blank" href="{{ asset(Storage::url($data->file)) }}" title="Download"><i class="fas fa-download"></i> Download Surat Masuk</a>
                </div>
            </div>
            <div class="card-footer">
                <a class="btn btn-danger" href="{{ route('entry-letters.index') }}">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $("#disposition_id").select2({
            placeholder: "Pilih Disposisi",
            allowClear: true,
            width: '100%',
        });
    });
</script>
@endsection
