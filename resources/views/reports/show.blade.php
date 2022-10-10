@extends('layout.main')
@section('container')
    <div class="row">
        <div class="col-12">
            <div class="callout callout-info">
                <h5><i class="fas fa-info"></i> Note:</h5>
                This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
            </div>

            <!-- Main content -->
            <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h4>
                        <img class="img-fluid" src="{{ asset('logo/logo-uiii.png') }}" style="max-width: 300px">
                        <small class="float-right">Hari, Tanggal: {{ date('D, d M Y', strtotime($data->tanggal_dibuat)) }}</small>
                    </h4>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row mt-4 invoice-info">
                <div class="col-sm-2 invoice-col">
                <strong>Name</strong>
                <address>
                    <strong>Jabatan</strong><br>
                    <strong>NRP</strong><br>
                    <strong>Email</strong>
                </address>
                </div>
                <div class=" invoice-col">
                : {{ $data->user->name }}<br>
                <address>
                    : Staff IT<br>
                    : {{ $data->user->nrp }}<br>
                    : {{ $data->user->email }}<br>
                    
                </address>
                </div>
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                    <th>No</th>
                    <th width=20%>Kegiatan</th>
                    <th>Keterangan</th>
                    <th>Lampiran</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        @php
                        $images = explode('|', $data->filenames);    
                        @endphp
                        <td>1</td>
                        <td>{{ $data->kegiatan }}</td>
                        <td>{{ $data->keterangan }}</td>
                        <td>
                            @foreach ($images as $image)
                                <img src="{{ $image }}" alt="{{ $image }}">
                            @endforeach
                        </td>
                    </tr>
                    </tbody>
                </table>
                </div>
            </div>

            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-12">
                    <a href="/reports" class="btn btn-danger"><i class="fas fa-chevron-left"></i> Back</a>
                    <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                        <i class="fas fa-download"></i> Generate PDF
                    </button>
                </div>
            </div>
            </div>
            <!-- /.invoice -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection