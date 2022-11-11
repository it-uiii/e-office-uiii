@extends('layout.main')
@section('container')
@foreach ($client as $item)
    <div class="card">
        <div class="media">
            <img class="mr-3 img-fluid" style="max-width: 200px" src="{{ $item->thumbnail_link }}" alt="Generic placeholder image">
            <div class="media-body">
                <h5 class="mt-0">{{ $item->title }}</h5>
                {!! $item->short_description !!}
                <br>
                <a href="">read more</a>
            </div>
        </div>
    </div>
@endforeach
@endsection