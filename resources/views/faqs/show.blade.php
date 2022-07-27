@extends('layout.main')
@section('container')
            <div class="row my-3">
                <div class="col-md-8 card">
                    <h2>{{ $service->title }}</h2>
                    <img class="img-fluid" src="https://source.unsplash.com/1200x300?{{ $service->category->name }}" alt="...">
                    <article class="my-3 fs-6">
                        {!! $service->body !!}
                    </article>
                    <a href="/services">Back to services</a>
                </div>
            </div>
@endsection