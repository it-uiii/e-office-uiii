@extends('layout.main')
@section('styles')
<link rel="stylesheet" href="{{ asset('plugins/jquery-fancybox/jquery.fancybox.css') }}">
@endsection
@section('container')
<div class="row">
    <div class="col-md-6 mb-3">
        <div class="card card-primary">
            <form action="{{ route('outgoing-letters.update', $data) }}" method="post" enctype="multipart/form-data">
                @csrf @method('put')
                <div class="card-body">
                    @role('Admin')
                        <div class="form-group">
                            <label for="number">Nomor Surat</label>
                            <input type="text" class="form-control @error('number') is-invalid @enderror" id="number" name="number" placeholder="Masukkan Nomor Surat" value="{{ old('number', $data->number) }}">
                            @error('number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    @endrole
                    <div class="form-group">
                        <label for="subject">Perihal</label>
                        <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" placeholder="Masukkan Perihal" value="{{ old('subject', $data->subject) }}">
                        @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="date">Tanggal Surat</label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" placeholder="" value="{{ old('date', $data->date) }}">
                        @error('date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="destination">Tujuan</label>
                        <input type="text" class="form-control @error('destination') is-invalid @enderror" id="destination" name="destination" placeholder="Masukkan Tujuan" value="{{ old('destination', $data->destination) }}">
                        @error('destination')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                                <input type="file" multiple class="custom-file-input" id="file" name="file[]" aria-describedby="file" aria-label="Upload">
                                <label class="custom-file-label" for="file">Masukkan beberapa lampiran ... </label>
                            </div>
                        </div>
                        @error('file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    @role('Admin|Pimpinan')
                        <div class="form-group">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="acc1" name="acc" class="custom-control-input" value="1">
                                <label class="custom-control-label" for="acc1">Acc</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="acc2" name="acc" class="custom-control-input" value="2">
                                <label class="custom-control-label" for="acc2">Tidak</label>
                            </div>
                        </div>
                        <div class="form-group revision">
                            <input type="hidden" id="revision" name="revision" value="{{ old('revision',$data->revision) }}">
                            <label for="revision_description">Revisi</label>
                            <textarea type="text" class="form-control @error('revision_description') is-invalid @enderror" id="revision_description" name="revision_description" placeholder="Masukkan Revisi">{{ old('revision_description', $data->revision_description) }}</textarea>
                            @error('revision_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    @endrole
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a class="btn btn-danger" href="{{ route('outgoing-letters.index') }}">Kembali</a>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <label>Lampiran</label>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($data->additionals as $item)
                        <div class="col-md-6 mb-3">
                            <a href="{{ asset(Storage::url($item->file)) }}" data-fancybox="lampiran">
                                <img src="{{ asset(Storage::url($item->file)) }}" class="img-thumbnail">
                            </a>
                            <form action="{{ route('additionals.destroy', $item) }}" method="post">
                                @csrf @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm btn-block mt-2" onclick="return confirm('Apakah anda yakin?')">Hapus</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('plugins/jquery-fancybox/jquery.fancybox.js') }}"></script>
<script>
    $(document).ready(function() {
        if ($("#revision").val() == "") {
            $('.revision').hide();
        } else {
            $('.revision').show();
        }
        $('input[type=radio][name=acc]').change(function() {
            if (this.value == 2) {
                $("#revision").val(1);
                $('.revision').show();
            } else {
                $("#revision").val("");
                $('.revision').hide();
            }
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
