@extends('layouts.frontend.app')
@push('title') {{ $page->name }} @endpush
@section('content')
    <section id="hero" class="d-flex align-items-center" style="height: 350px">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center" data-aos-delay="100">
                    <h1>{{ $page->name }}</h1>
                    <h2><a href="{{ url('/') }}">Home</a></h2>
                </div>
            </div>
        </div>
    </section><!-- End Hero -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">
            <div class="row">
                <div class="portfolio-description">
                    <h2>{{ $page->title }}</h2>
                    <p>
                        {!! $page->description !!}
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection

