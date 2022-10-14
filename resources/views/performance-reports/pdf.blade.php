<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Kinerja Harian - {{ $data->report_created_by->name }} - {{ tgl($data->date) }}</title>
    <style>
        .page-break {
            page-break-after: always;
        }

        html {
            font-family: sans-serif;
            line-height: 1.5;
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        }

        body {
            margin-top: 2.5cm;
            margin-left: 1cm;
            margin-right: 1cm;
        }

        /** Define the header rules **/
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
        }

        .font-weight-bold {
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        .table {
            width: 100%;
        }

        .table th {
            padding: 5px;
        }

        .table td {
            padding: 5px;
            vertical-align: text-top;
        }

        .table-bordered {
            border: 1px solid #000;
            border-collapse: collapse;
        }

        .table-bordered td, .table-bordered th {
            border: 1px solid #000;
        }

        .mt-3 {
            margin-top: 1rem;
        }

        .mt-5 {
            margin-top: 3rem;
        }

        .w-100 {
            width: 100%;
        }

    </style>
</head>
<body>
    <header>
        <img src="{{ asset('img/header.png') }}" alt="Header">
    </header>
    <div class="text-center mt-3">
        <h4>LAPORAN KINERJA HARIAN<br>PEGAWAI UNIVERSITAS ISLAM INTERNASIONAL INDONESIA</h4>
    </div>
    <div class="mt-3">
        <table>
            <tr>
                <td style="width: 100px">Nama</td>
                <td style="width: 5px">:</td>
                <td>{{ $data->report_created_by->name }}</td>
            </tr>
            <tr>
                <td style="width: 100px">Jabatan</td>
                <td style="width: 5px">:</td>
                <td>{{ $data->report_created_by->position->name }}</td>
            </tr>
            <tr>
                <td style="width: 100px">Hari, Tanggal</td>
                <td style="width: 5px">:</td>
                <td>{{ hari(date('N', strtotime($data->date))) }}, {{ tgl($data->date) }}</td>
            </tr>
        </table>
    </div>
    <div class="mt-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kegiatan</th>
                    <th>Output</th>
                    <th>Volume</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data->activities as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->activity }}</td>
                        <td>{{ $item->output }}</td>
                        <td>{{ $item->volume }}</td>
                        <td>{{ $item->description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-5">
        <table class="w-100">
            <tr>
                <td class="text-center"><br>Pemimpin Penilai<br>
                    <img class="w-100" src="{{ asset(Storage::url($data->signature_leader)) }}" alt=""><br>
                    <u>{{ $data->report_created_by->name }}</u><br>
                    {{ $data->report_created_by->position->name }}
                </td>
                <td class="text-center">Depok, {{ tgl($data->date) }}<br>Pegawai yang dinilai<br>
                    <img class="w-100" src="{{ asset(Storage::url($data->signature_reporter)) }}" alt=""><br>
                    <u>{{ $data->report_created_by->name }}</u><br>
                    {{ $data->report_created_by->position->name }}
                </td>
            </tr>
        </table>
    </div>
    {{-- Page Break --}}
    <div class="page-break"></div>
    <div class="text-center">
        <h4>LAMPIRAN</h4>
    </div>
    @foreach ($data->additional_reports as $item)
        <img src="{{ asset(Storage::url($item->file)) }}" alt="{{ $item->file }}" width="100%">
        <div class="pagenum"></div>
    @endforeach
</body>
</html>
