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
                        <input @if (session('user')->role != 'Admin' || session('user')->position != 'Pelaksana Sekretariat') readonly @endif type="text" class="form-control @error('number') is-invalid @enderror" id="number" name="number" placeholder="Masukkan Perihal" value="{{ old('number', $data->number) }}">
                        @error('number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="subject">Perihal</label>
                        <input @if (session('user')->role != 'Admin' || session('user')->position != 'Pelaksana Sekretariat') readonly @endif type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" placeholder="Masukkan Perihal" value="{{ old('subject', $data->subject) }}">
                        @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="date_in">Tanggal Diterima</label>
                        <input @if (session('user')->role != 'Admin' || session('user')->position != 'Pelaksana Sekretariat') readonly @endif type="date" class="form-control @error('date_in') is-invalid @enderror" id="date_in" name="date_in" placeholder="" value="{{ old('date_in', $data->date_in) }}">
                        @error('date_in')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="sender">Pengirim</label>
                        <input @if (session('user')->role != 'Admin' || session('user')->position != 'Pelaksana Sekretariat') readonly @endif type="text" class="form-control @error('sender') is-invalid @enderror" id="sender" name="sender" placeholder="Nama Instansi" value="{{ old('sender', $data->sender) }}">
                        @error('sender')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    @if (session('user')->position && session('user')->position == 'Rektor')
                        <div class="form-group">
                            <label for="disposition_id">Disposisi</label>
                            <select @if (session('user')->role != 'Admin' || session('user')->position != 'Pelaksana Sekretariat') readonly @endif multiple class="form-control @error('disposition_id') is-invalid @enderror" id="disposition_id" name="disposition_id[]">
                                @foreach ($users as $item)
                                    <option value="{{ $item->id }}" {{ in_array($item->id, old('disposition_id', $data->dispositions->pluck('user_id')->toArray(),[])) ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('disposition_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    @endif
                    @if (session('user')->role == 'Admin' && session('user')->position == 'Pelaksana Sekretariat')
                        <div class="form-group">
                            <label for="description">Keterangan</label>
                            <textarea @if (session('user')->role != 'Admin' || session('user')->position != 'Pelaksana Sekretariat') readonly @endif type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Masukkan Keterangan">{{ old('description', $data->description) }}</textarea>
                            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group">
                            <label for="file">File</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" accept=".pdf" class="custom-file-input" id="file" aria-describedby="file" aria-label="Upload">
                                    <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <a class="btn btn-outline-success" target="_blank" href="{{ asset(Storage::url($data->file)) }}" title="Download"><i class="fas fa-download"></i></a>
                                </div>
                            </div>
                            @error('file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    @else
                        <div class="form-group">
                            <label for="description">Keterangan</label>
                            <div class="border rounded p-2" style="background-color: #e9ecef; color: #495057;" id="description" name="description">{!! $data->description !!}</div>
                        </div>
                        <div class="form-group">
                            <a class="btn btn-outline-success" target="_blank" href="{{ asset(Storage::url($data->file)) }}" title="Download"><i class="fas fa-download"></i> Download Surat Masuk</a>
                        </div>
                    @endif
                    @if (session('user')->position && (session('user')->position == 'Rektor' || session('user')->position == 'KTU Sekretaris'))
                        <div class="form-group">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="acc1" name="acc" class="custom-control-input" value="1" {{ old('acc') == 1 ? 'checked' : '' }}>
                                <label class="custom-control-label" for="acc1">Acc</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="acc2" name="acc" class="custom-control-input" value="2" {{ old('acc') == 2 ? 'checked' : '' }}>
                                <label class="custom-control-label" for="acc2">Tidak</label>
                            </div>
                        </div>
                        <div class="form-group revision">
                            <input type="hidden" id="revision" name="revision" value="{{ old('revision',$data->revision) }}">
                            <label for="revision_description">Revisi</label>
                            <textarea type="text" class="form-control @error('revision_description') is-invalid @enderror" id="revision_description" name="revision_description" placeholder="Masukkan Revisi">{{ old('revision_description', $data->revision_description) }}</textarea>
                            @error('revision_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    @endif
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
@if (session('user')->role == 'Admin' && session('user')->position == 'Pelaksana Sekretariat')
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
@endif
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
    $(document).ready(function () {
        if ($("#revision").val() == "") {
            $('.revision').hide();
        } else {
            $('.revision').show();
        }
        $('input[type=radio][name=acc]').change(function() {
            if (this.value == 2) {
                $("#revision").val(1);
                $('.revision').show();
                $(".signature").addClass('d-none');
            } else {
                $("#revision").val("");
                $('.revision').hide();
                $(".signature").removeClass('d-none');
            }
        });
    });
</script>
@endsection
