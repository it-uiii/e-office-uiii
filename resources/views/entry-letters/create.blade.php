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
                <div class="card-body">
                    <div class="form-group">
                        <label for="number">Nomor Surat</label>
                        <input type="text" class="form-control @error('number') is-invalid @enderror" id="number" name="number" placeholder="Masukkan Perihal" value="{{ old('number') }}">
                        @error('number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="subject">Perihal</label>
                        <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" placeholder="Masukkan Perihal" value="{{ old('subject') }}">
                        @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="date_in">Tanggal Diterima</label>
                        <input type="date" class="form-control @error('date_in') is-invalid @enderror" id="date_in" name="date_in" placeholder="" value="{{ old('date_in') }}">
                        @error('date_in')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="sender">Pengirim</label>
                        <input type="text" class="form-control @error('sender') is-invalid @enderror" id="sender" name="sender" placeholder="Nama Instansi" value="{{ old('sender') }}">
                        @error('sender')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Keterangan</label>
                        <textarea type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Masukkan Keterangan">{{ old('description') }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="file">File</label>
                        <div class="input-group">
                            <input type="file" accept=".pdf" class="form-control" id="file" name="file" aria-describedby="file" aria-label="Upload">
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
@if (session('user')->position && session('user')->position == 'Rektor')
    <script>
        $(document).ready(function() {
            $("#disposition_id").select2({
                placeholder: "Pilih Disposisi",
                allowClear: true,
                width: '100%',
            });
        });
    </script>
@endif
<script>
    $(document).ready(function() {
        $("#disposition_id").select2({
            placeholder: "Pilih Disposisi",
            allowClear: true,
            width: '100%',
        });
        $("#description").summernote({
            height: 200,
            placeholder: 'Masukkan Deskripsi',
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']],
            ],
        });
    });
</script>
@endsection
