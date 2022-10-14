@extends('layout.main')
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
</style>
@endsection
@section('container')
<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-body">
                <div class="form-group">
                    <label for="number">Nomor Surat</label>
                    <input disabled type="text" class="form-control" id="number" name="number" placeholder="Masukkan Nomor Surat" value="{{ old('number', $outgoing_letter->number) }}">
                </div>
                <div class="form-group">
                    <label for="subject">Perihal</label>
                    <input disabled type="text" class="form-control" id="subject" name="subject" placeholder="Masukkan Perihal" value="{{ old('subject', $outgoing_letter->subject) }}">
                </div>
                <div class="form-group">
                    <label for="date">Tanggal Surat</label>
                    <input disabled type="date" class="form-control" id="date" name="date" placeholder="" value="{{ old('date', $outgoing_letter->date) }}">
                </div>
                <div class="form-group">
                    <label for="destination">Tujuan</label>
                    <input disabled type="text" class="form-control" id="destination" name="destination" placeholder="Masukkan Tujuan" value="{{ old('destination', $outgoing_letter->destination) }}">
                </div>
                <div class="form-group">
                    <label for="description">Keterangan</label>
                    <div class="border rounded p-2" style="background-color: #e9ecef; color: #495057;" id="description" name="description">{!! old('description', $outgoing_letter->description) !!}</div>
                </div>
                <div class="form-group">
                    {!! $outgoing_letter->display_status !!}
                </div>
                @if ($outgoing_letter->revision)
                    <div class="form-group">Revision</div>
                    <textarea disabled type="text" class="form-control" id="revision_description" name="revision_description" placeholder="Masukkan Keterangan">{{ old('revision_description', $outgoing_letter->revision_description) }}</textarea>
                @endif
            </div>
            <div class="card-footer">
                <a class="btn btn-danger" href="{{ route('outgoing-letters.index') }}">Kembali</a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <label>Lampiran</label>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($outgoing_letter->additionals as $item)
                        <div class="col-md-6 mb-3">
                            <a href="{{ asset(Storage::url($item->file)) }}" data-fancybox="lampiran">
                                <img src="{{ asset(Storage::url($item->file)) }}" class="image border rounded">
                            </a>
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
@endsection
