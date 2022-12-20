@extends('layout.secondary')
@section('styles')
<link rel="stylesheet" href="{{ asset('plugins/jquery-fancybox/jquery.fancybox.css') }}">
<style>
    .image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        transition: all 0.3s ease-in-out;
    }
    .image:hover {
        box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.1);
    }
    .wrapper-ttd {
        position: relative;
        width: 100%;
        height: 200px;
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
        user-select: none;
        border: solid 1px #ddd;
        margin: 10px 0px;
    }
    .signature-pad {
        position: absolute;
        left: 0;
        top: 0;
        width: 400px;
        height:200px;
    }
    #signature {
        display: none;
    }
</style>
@endsection
@section('container')
<div class="row">
    <div class="col-md-6 mb-3">
        <div class="card card-primary">
            <form action="{{ route('outgoing-letters.update', $data) }}" method="post" enctype="multipart/form-data">
                @csrf @method('put')
                <div class="card-body">
                    <div class="form-group">
                        <label for="number">Nomor Surat</label>
                        <input @if(session('user')->position && session('user')->position != 'Pelaksana Sekretariat') readonly @endif type="text" class="form-control @error('number') is-invalid @enderror" id="number" name="number" placeholder="Masukkan Nomor Surat" value="{{ old('number', $data->number) }}">
                        @error('number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="subject">Perihal</label>
                        <input @if((session('user')->position && session('user')->position != 'Pelaksana Sekretariat') && session('user')->role != 'Staff') readonly @endif type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" placeholder="Masukkan Perihal" value="{{ old('subject', $data->subject) }}">
                        @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="date">Tanggal Surat</label>
                        <input @if((session('user')->position && session('user')->position != 'Pelaksana Sekretariat') && session('user')->role != 'Staff') readonly @endif type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" placeholder="" value="{{ old('date', $data->date) }}">
                        @error('date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="destination">Tujuan</label>
                        <input @if((session('user')->position && session('user')->position != 'Pelaksana Sekretariat') && session('user')->role != 'Staff') readonly @endif type="text" class="form-control @error('destination') is-invalid @enderror" id="destination" name="destination" placeholder="Masukkan Tujuan" value="{{ old('destination', $data->destination) }}">
                        @error('destination')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    @if((session('user')->position && session('user')->position == 'Pelaksana Sekretariat') || session('user')->role == 'Staff')
                        <div class="form-group">
                            <label for="description">Keterangan</label>
                            <textarea type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Masukkan Keterangan">{{ old('description', $data->description) }}</textarea>
                            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group">
                            <label for="file">File</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" accept="image/*" multiple class="custom-file-input" id="file" name="file[]" aria-describedby="file" aria-label="Upload">
                                    <label class="custom-file-label" for="file">Masukkan beberapa lampiran ... </label>
                                </div>
                            </div>
                            @error('file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    @else
                        <div class="form-group">
                            <label for="description">Keterangan</label>
                            <div class="border rounded p-2" style="background-color: #e9ecef; color: #495057;" id="description" name="description">{!! old('description', $data->description) !!}</div>
                            <textarea type="text" class="form-control d-none" id="description" name="description" readonly placeholder="Masukkan Keterangan">{{ old('description', $data->description) }}</textarea>
                        </div>
                    @endif
                    @role('Admin|Pimpinan')
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
                        @if (session('user')->position == 'Rektor')
                            <div class="form-group signature d-none">
                                <i>Tanda Tangan</i>
                                <div class="wrapper-ttd">
                                    <canvas id="signature-pad" class="signature-pad" width="400" height="200"></canvas>
                                </div>
                                <button id="clear" type="button" class="btn btn-secondary">Hapus TTD</button>
                                <button id="submit-signature" type="button" class="btn btn-success">Simpan TTD</button>
                                <textarea type="hidden" id='signature' name="signature"></textarea>
                            </div>
                        @endif
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
                                <img src="{{ asset(Storage::url($item->file)) }}" class="image border rounded">
                            </a>
                            @if((session('user')->position && session('user')->position == 'Pelaksana Sekretariat') || session('user')->role == 'Staff')
                                <form action="{{ route('additionals.destroy', $item) }}" method="post">
                                    @csrf @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm btn-block mt-1" onclick="return confirm('Apakah anda yakin?')">Hapus</button>
                                </form>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@if (session('user')->position == 'Rektor')
<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
<script>
    var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
            backgroundColor: 'rgba(255, 255, 255, 0)',
    penColor: 'rgb(0, 0, 0)'
    });
    $(document).ready(function() {
        $('#submit-signature').click(function() {
            var imageData = signaturePad.toDataURL('image/png');
            $('#signature').val(imageData);
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("tanda tangan berhasil disimpan");
        });

        // action on click button clea
        $('#clear').click(function(e) {
            e.preventDefault();
            signaturePad.clear();
            $('#signature').val('');
        });
    });
</script>
@endif
<script src="{{ asset('plugins/jquery-fancybox/jquery.fancybox.js') }}"></script>
@if((session('user')->position && session('user')->position == 'Pelaksana Sekretariat') || session('user')->role == 'Staff')
    <script>
        $(document).ready(function() {
            $("#description").summernote({
                height: 200,
                placeholder: 'Masukkan Deskripsi',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
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
