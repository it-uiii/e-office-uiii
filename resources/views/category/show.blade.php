@extends('layout.main')
@section('container')
            <div class="row my-3">
                <div class="col-md-8 card">
                    <h2>{{ $service->title }}</h2>
                    @if ($service->cover)
                    <div style="max-width: 350px; overflow: hidden;">
                        <img class="img-fluid" src="{{ asset('storage/'.$service->cover) }}" alt="{{ $service->cover }}">
                    </div>
                    @else
                        <img class="img-fluid" src="https://source.unsplash.com/1200x300?{{ $service->category->name }}" alt="...">
                    @endif
                    <article class="my-3 fs-6">
                        {!! $service->body !!}
                    </article>
                    <a href="/services">Back to services</a>
                </div>
            </div>
@endsection