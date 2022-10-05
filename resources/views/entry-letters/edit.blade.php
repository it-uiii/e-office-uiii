@extends('layout.main')
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('container')
<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <form action="{{ route('entry-letters.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $data->id }}">
                <div class="card-body">
                    <div class="form-group">
                        <label for="number">Nomor Surat</label>
                        <input type="text" class="form-control @error('number') is-invalid @enderror" id="number" name="number" placeholder="Masukkan Perihal" value="{{ old('number', $data->number) }}">
                        @error('number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="subject">Perihal</label>
                        <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" placeholder="Masukkan Perihal" value="{{ old('subject', $data->subject) }}">
                        @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="date_letters">Tanggal Surat</label>
                        <input type="date" class="form-control @error('date_letters') is-invalid @enderror" id="date_letters" name="date_letters" placeholder="" value="{{ old('date_letters', $data->date_letters) }}">
                        @error('date_letters')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="date_in">Tanggal Diterima</label>
                        <input type="date" class="form-control @error('date_in') is-invalid @enderror" id="date_in" name="date_in" placeholder="" value="{{ old('date_in', $data->date_in) }}">
                        @error('date_in')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="sender">Pengirim</label>
                        <input type="text" class="form-control @error('sender') is-invalid @enderror" id="sender" name="sender" placeholder="Nama Instansi" value="{{ old('sender', $data->sender) }}">
                        @error('sender')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="disposition_id">Disposisi</label>
                        <select multiple class="form-control @error('disposition_id') is-invalid @enderror" id="disposition_id" name="disposition_id[]">
                            @foreach ($users as $item)
                                <option value="{{ $item->id }}" {{ in_array($item->id, old('disposition_id', $data->dispositions->pluck('user_id')->toArray(),[])) ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('disposition_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Keterangan</label>
                        <textarea type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Masukkan Keterangan">{{ old('description', $data->description) }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="file">File</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" accept=".docx,.pdf" class="custom-file-input" id="file" aria-describedby="file" aria-label="Upload">
                                <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <a class="btn btn-outline-success" target="_blank" href="{{ asset(Storage::url($data->file)) }}" title="Download"><i class="fas fa-download"></i></a>
                            </div>
                        </div>
                        @error('file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a class="btn btn-danger" href="{{ route('entry-letters.index') }}">Kembali</a>
                </div>
            </form>
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
