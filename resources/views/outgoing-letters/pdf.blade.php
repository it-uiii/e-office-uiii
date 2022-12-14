<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $data->subject }}</title>
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <style>
        .page-break {
            page-break-after: always;
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
    </style>
</head>
<body>
    <header>
        <img src="{{ asset('img/header.png') }}" alt="Header">
    </header>
    <div class="text-right mt-3">
        {{ tgl($data->date) }}
    </div>
    <table style="width: 50%;">
        <tr>
            <td class="align-top">Nomor</td>
            <td class="align-top">:</td>
            <td class="align-top">{{ $data->number }}</td>
        </tr>
        <tr>
            <td class="align-top">Perihal</td>
            <td class="align-top">:</td>
            <td class="align-top">{{ $data->subject }}</td>
        </tr>
    </table>
    <div class="mt-3" style="width: 50%;">
        Kepada Yth.
        <br>
        <strong>{{ $data->destination }}</strong>
        <br>
        di
        <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tempat
    </div>
    <div class="mt-3">
        {!! $data->description !!}
    </div>
    <div class="mt-5" style="width: 30%; margin-left: 70%;">
        Hormat Saya,
        <br>
        {{ auth()->user()->position ? auth()->user()->position->name : ''}}
        @if ($data->signature)
            <br>
            <img src="{{ asset(Storage::url($data->signature)) }}" alt="Signature" style="width: 100px;">
            <br>
        @else
            <br>
            <br>
            <br>
            <br>
        @endif
        <strong>{{ auth()->user()->name }}</strong>
    </div>
    {{-- Page Break --}}
    <div class="page-break"></div>
    <div class="text-center">
        <h5>Lampiran</h5>
    </div>
    @foreach ($data->additionals as $item)
        <img src="{{ asset(Storage::url($item->file)) }}" alt="{{ $item->file }}" width="100%">
        <div class="pagenum"></div>
    @endforeach
</body>
</html>
