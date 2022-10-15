@extends('layout.main')
@section('styles')
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
        width: 550px;
        height:200px;
    }
    #signature-reporter {
        display: none;
    }
    #signature-leader {
        display: none;
    }
</style>
@endsection
@section('container')
<div class="row">
    <div class="col-md-6">
        <form action="{{ route('performance-reports.update', $performance_report->id) }}" method="post" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="card card-primary">
                <div class="card-body">
                    <div class="form-group">
                        <label for="date">Tanggal</label>
                        <input type="date" class="form-control " id="date" name="date" value="{{ $performance_report->date }}">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="file">Lampiran</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" accept="image/*" multiple class="custom-file-input" id="file" name="file[]" aria-describedby="file" aria-label="Upload">
                                <label class="custom-file-label" for="file">Masukkan beberapa lampiran ...</label>
                            </div>
                        </div>
                        <div class="invalid-feedback"></div>
                    </div>
                    @if ($performance_report->created_by == auth()->user()->id)
                        <div class="form-group signature-reporter d-none">
                            <i>Tanda Tangan Yang Dinilai</i>
                            <div class="wrapper-ttd">
                                <canvas id="signature-pad-reporter" class="signature-pad" width="400" height="200">
                                </canvas>
                            </div>
                            <button id="clear-reporter" type="button" class="btn btn-secondary">Hapus TTD</button>
                            <button id="submit-signature-reporter" type="button" class="btn btn-success">Simpan TTD</button>
                            <textarea type="hidden" id='signature-reporter' name="signature_reporter"></textarea>
                        </div>
                    @else
                        @role('Pimpinan')
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
                                <input type="hidden" id="revision" name="revision" value="{{ old('revision',$performance_report->revision) }}">
                                <label for="revision_description">Revisi</label>
                                <textarea type="text" class="form-control @error('revision_description') is-invalid @enderror" id="revision_description" name="revision_description" placeholder="Masukkan Revisi">{{ old('revision_description', $performance_report->revision_description) }}</textarea>
                                @error('revision_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group signature-leader d-none">
                                <i>Tanda Tangan Penilai</i>
                                <div class="wrapper-ttd">
                                    <canvas id="signature-pad-leader" class="signature-pad" width="550" height="200"></canvas>
                                </div>
                                <button id="clear-leader" type="button" class="btn btn-secondary">Hapus TTD</button>
                                <button id="submit-signature-leader" type="button" class="btn btn-success">Simpan TTD</button>
                                <textarea type="hidden" id='signature-leader' name="signature_leader"></textarea>
                            </div>
                        @endrole
                    @endif
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a class="btn btn-danger" href="{{ route('performance-reports.index') }}">Kembali</a>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <label>Lampiran</label>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($performance_report->additional_reports as $item)
                        <div class="col-md-6 mb-3">
                            <a href="{{ asset(Storage::url($item->file)) }}" data-fancybox="lampiran">
                                <img src="{{ asset(Storage::url($item->file)) }}" class="image border rounded">
                            </a>
                            <form action="{{ route('additional-reports.destroy', $item) }}" method="post">
                                @csrf @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm btn-block mt-1" onclick="return confirm('Apakah anda yakin?')">Hapus</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <a href="#activityModal" data-toggle="modal" class="btn btn-primary btn-sm add-activity"><i class="fas fa-plus"></i> Tambah Kegiatan</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kegiatan</th>
                                <th>Output</th>
                                <th>Volume</th>
                                <th>Keterangan</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($performance_report->activities as $activity)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $activity->activity }}</td>
                                    <td>{{ $activity->output }}</td>
                                    <td>{{ $activity->volume }}</td>
                                    <td>{{ $activity->description }}</td>
                                    <td>
                                        <a href="#activityModal" class="btn btn-warning btn-sm edit-activity"
                                            data-toggle="modal"
                                            data-id="{{ $activity->id }}"
                                            data-activity="{{ $activity->activity }}"
                                            data-output="{{ $activity->output }}"
                                            data-volume="{{ $activity->volume }}"
                                            data-description="{{ $activity->description }}"><i class="fas fa-pen"></i>
                                        </a>
                                        <form action="{{ route('activities.destroy', $activity->id) }}" method="post" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin?')"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="activityModal" tabindex="-1" aria-labelledby="activityModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('activities.store') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="activityModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="performance_report_id" value="{{ $performance_report->id }}">
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <label for="activity">Kegiatan</label>
                        <input type="text" name="activity" id="activity" class="form-control" placeholder="Masukkan Kegiatan">
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="form-group">
                        <label for="output">Output</label>
                        <input type="text" name="output" id="output" class="form-control" placeholder="Masukkan Output">
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="form-group">
                        <label for="volume">Volume</label>
                        <input type="text" name="volume" id="volume" class="form-control" placeholder="Masukkan Volume">
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="form-group">
                        <label for="description">Keterangan</label>
                        <textarea name="description" id="description" class="form-control" placeholder="Masukkan Keterangan"></textarea>
                        <span class="invalid-feedback"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
@if ($performance_report->created_by == auth()->user()->id)
    <script>
        var signaturePadReport = new SignaturePad(document.getElementById('signature-pad-reporter'), {
            backgroundColor: 'rgba(255, 255, 255, 0)',
            penColor: 'rgb(0, 0, 0)'
        });
        $(document).ready(function() {
            $('#submit-signature-reporter').click(function() {
                let imageData = signaturePadReport.toDataURL('image/png');
                $('#signature-reporter').val(imageData);
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true
                }
                toastr.success("tanda tangan berhasil disimpan");
            });

            // action on click button clea
            $('#clear-reporter').click(function(e) {
                e.preventDefault();
                signaturePadReport.clear();
                $('#signature-reporter').val('');
                $("#preview-signature-reporter").attr("src", "");
            });
        });
    </script>
@else
    <script>
        var signaturePadLeader = new SignaturePad(document.getElementById('signature-pad-leader'), {
            backgroundColor: 'rgba(255, 255, 255, 0)',
            penColor: 'rgb(0, 0, 0)'
        });
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
                    $(".signature-leader").addClass('d-none');
                } else {
                    $("#revision").val("");
                    $('.revision').hide();
                    $(".signature-leader").removeClass('d-none');
                }
            });

            $('#submit-signature-leader').click(function() {
                let imageData = signaturePadLeader.toDataURL('image/png');
                $('#signature-leader').val(imageData);
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true
                }
                toastr.success("tanda tangan berhasil disimpan");
            });

            // action on click button clea
            $('#clear-leader').click(function(e) {
                e.preventDefault();
                signaturePadLeader.clear();
                $('#signature-leader').val('');
                $("#preview-signature-leader").attr("src", "");
            });
        });
    </script>
@endif
<script>
    $(document).ready(function() {
        $(".add-activity").click(function () {
            $("#activityModalLabel").html("Tambah Kegiatan");
            $("#activityModal form")[0].reset();
            $("#activityModal .invalid-feedback").html("");
            $("#activityModal .form-control").removeClass("is-invalid");
        });

        $(".edit-activity").click(function () {
            $("#activityModalLabel").html("Ubah Kegiatan");
            $("#id").val($(this).data("id"));
            $("#activity").val($(this).data("activity"));
            $("#output").val($(this).data("output"));
            $("#volume").val($(this).data("volume"));
            $("#description").val($(this).data("description"));
            $("#activityModal .invalid-feedback").html("");
            $("#activityModal .form-control").removeClass("is-invalid");
        });

        $(document).on('submit', '#activityModal form', function (event) {
            event.preventDefault();
            const form = $(this);
            const btnHtml = $(form).find('button[type="submit"]').html();
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    $(form).find('button[type="submit"]').attr('disabled', 'disabled');
                    $(form).find('button[type="submit"]').html(`<span class="spinner-border spinner-border-sm" role="status"></span>`);
                },
                success: function (response) {
                    $(form).find('button[type="submit"]').html(btnHtml);
                    $(form).find('button[type="submit"]').removeAttr('disabled');
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true
                    }
                    toastr.success(response.message);
                    $("#activityModal").modal("hide");
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                },
                error: function (response) {
                    console.clear();
                    $(form).find('button[type="submit"]').html(btnHtml);
                    $(form).find('button[type="submit"]').removeAttr('disabled');
                    let focus = true;
                    $.each(response.responseJSON.errors, function (i, e) {
                        if (e.length > 1) {
                            $.each(e, function (key, item) {
                                toastr.options = {
                                    "closeButton": true,
                                    "progressBar": true
                                }
                                toastr.error(item);
                            });
                        } else {
                            toastr.options = {
                                "closeButton": true,
                                "progressBar": true
                            }
                            toastr.error(e);
                        }
                        if (!$("[name='" + i + "']").hasClass('is-invalid')) {
                            $("[name='" + i + "']").addClass('is-invalid');
                            $("[name='" + i + "']").siblings('.invalid-feedback').html(e);
                            if ($("[name='" + i + "']").is(':radio')) {
                                $("[name='" + i + "']").parent().parent().siblings('.invalid-feedback').html(e);
                            }
                            if ($("[name='" + i + "']").is(':checkbox')) {
                                $("[name='" + i + "']").parent().parent().siblings('.invalid-feedback').html(e);
                            }
                            if ($("[name='" + i + "']").is('select')) {
                                $("[name='" + i + "']").siblings('.select2').children('.selection').children('.select2-selection').css('border-color', '#FF5370');
                            }
                            if (focus) {
                                $("[name='" + i + "']").focus();
                                focus = false;
                            }
                        }
                    });
                }
            });
        });
    });
</script>
@endsection
