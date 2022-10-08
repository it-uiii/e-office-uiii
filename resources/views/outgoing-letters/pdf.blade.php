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
    </style>
</head>
<body>
    <img src="{{ asset('img/header.png') }}" alt="Header">
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
        {{ auth()->user()->position->name }}
        <br>
        <br>
        <br>
        <br>
        <strong>{{ auth()->user()->name }}</strong>
    </div>
    {{-- Page Break --}}
    <div class="page-break"></div>
    <div class="text-center">
        <h5>Lampiran</h5>
    </div>
    @foreach ($data->additionals as $item)
        <img src="{{ asset(Storage::url($item->file)) }}" alt="{{ $item->file }}" width="100%">
    @endforeach
</body>
</html>
