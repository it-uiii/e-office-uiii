@extends('layout.main')
@section('styles')
{{-- <style>
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
    #signature-reporter {
        display: none;
    }
    #signature-leader {
        display: none;
    }
</style> --}}
@endsection
@section('container')
<form action="{{ route('performance-reports.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card card-primary">
        <div class="card-body">
            <div class="form-group">
                <label for="date">Tanggal</label>
                <input type="date" class="form-control " id="date" name="date">
                <div class="invalid-feedback"></div>
            </div>
            {{-- <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="form-group signature-reporter">
                        <i>Tanda Tangan Yang Dinilai</i>
                        <div class="wrapper-ttd">
                            <canvas id="signature-pad-report" class="signature-pad" width="400" height="200"></canvas>
                        </div>
                        <button id="clear-report" type="button" class="btn btn-secondary">Hapus TTD</button>
                        <button id="submit-signature-reporter" type="button" class="btn btn-success">Simpan TTD</button>
                        <textarea type="hidden" id='signature-reporter' name="signature_reporter"></textarea>
                    </div>
                </div>
            </div> --}}
            <div class="kegiatan mt-3">

            </div>
            <button type="button" id="add-activity" class="btn btn-success btn-block">Tambah Kegiatan</button>
        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a class="btn btn-danger" href="{{ route('performance-reports.index') }}">Kembali</a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
{{-- <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script> --}}
<script>
    // var signaturePadReport = new SignaturePad(document.getElementById('signature-pad-report'), {
    //     backgroundColor: 'rgba(255, 255, 255, 0)',
    //     penColor: 'rgb(0, 0, 0)'
    // });
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
        $('#clear-report').click(function(e) {
            e.preventDefault();
            signaturePadReport.clear();
            $('#signature-reporter').val('');
        });

        $("#add-activity").click(function () {
            $(".kegiatan").append(`
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <label for="activity">Kegiatan</label>
                                    <input type="text" name="activity[]" class="form-control" placeholder="Masukkan Kegiatan">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <label for="output">Output</label>
                                    <input type="text" name="output[]" class="form-control" placeholder="Masukkan Output">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <label for="volume">Volume</label>
                                    <input type="text" name="volume[]" class="form-control" placeholder="Masukkan Volume">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <label for="attachment">Lampiran</label>
                                    <input type="file" name="attachment[]" accept=".pdf" class="form-control" placeholder="Masukkan Lampiran">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="description">Keterangan</label>
                                    <textarea name="description[]" class="form-control" placeholder="Masukkan Keterangan"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="button" class="btn btn-danger btn-block remove-activity">Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>
            `);
        });

        $(document).on('click','.remove-activity',function(){
            $(this).closest('.card').remove();
        });

        $(document).on('submit', 'form', function (event) {
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
                    setTimeout(function () {
                        window.location.href = response.redirect;
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
