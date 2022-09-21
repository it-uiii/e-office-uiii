@extends('layout.main')
@section('container')
<div class="row">
    <div class="col-md-8">
        <div class="card card-primary">
            <form method="POST" action="/reports" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <label for="kegiatan" class="col-sm-2 col-form-label">Kegiatan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('kegiatan') is-invalid @enderror" id="kegiatan" name="kegiatan" placeholder="Example: monitoring acara" autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="output" class="col-sm-2 col-form-label">Output</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="output" name="output" placeholder="Example: Kegiatan telah dilakukan">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="volume" class="col-sm-2 col-form-label">Volume</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="volume" name="volume">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_dibuat" class="col-sm-2 col-form-label">Tanggal Dibuat</label>
                        <div class="col-sm-10">
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" id="tanggal_dibuat" name="tanggal_dibuat" data-target="#reservationdate"/>
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="keterangan" id="keterangan" rows="3" placeholder="Enter ..."></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="filenames" class="col-sm-2 col-form-label">Lampiran</label>
                        <div class="col-sm-10">
                            <div class="input-group hdtuto control-group lst increment" >
                                <input type="file" name="filenames[]" class="form-control">
                                <div class="input-group-btn"> 
                                    <button class="btn btn-success" type="button"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="clone hide">
                                <div class="hdtuto control-group lst input-group" style="margin-top:10px">
                                    <input type="file" name="filenames[]" class="form-control">
                                    <div class="input-group-btn"> 
                                    <button class="btn btn-danger" type="button"><i class="fas fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Create</button>
                    <a class="btn btn-danger" href="/reports">Cancel</a>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>
    </div>
</div>
@endsection