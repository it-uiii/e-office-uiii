@extends('layout.main')
@section('container')
<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <form action="{{ route('outgoing-letters.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="subject">Perihal</label>
                        <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" placeholder="Masukkan Perihal" value="{{ old('subject') }}">
                        @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="date">Tanggal Surat</label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" placeholder="" value="{{ old('date') }}">
                        @error('date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="destination">Tujuan</label>
                        <input type="text" class="form-control @error('destination') is-invalid @enderror" id="destination" name="destination" placeholder="Masukkan Tujuan" value="{{ old('destination') }}">
                        @error('destination')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Masukkan Deskripsi">{{ old('description') }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="file">Lampiran File</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" multiple accept="image/*" class="custom-file-input" id="file" name="file[]" aria-describedby="file" aria-label="Upload">
                                <label class="custom-file-label" for="file">Masukkan beberapa lampiran ...</label>
                            </div>
                        </div>
                        @error('file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a class="btn btn-danger" href="{{ route('outgoing-letters.index') }}">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
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
