@extends('layouts.frontend.app')
@push('title') {{ $blog->title }} @endpush
@push('style')

@endpush
@section('content')
    <section id="hero" class="d-flex align-items-center" style="height: 350px">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center" data-aos-delay="100">
                    <h1>{{ $blog->title }}</h1>
                    <h2><a href="{{ url('/') }}">Home</a></h2>
                </div>
            </div>
        </div>
    </section><!-- End Hero -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">
            <div class="row gy-4 justify-content-center">
                <div class="col-lg-10 text-center">
                    <img src="{{ $blog->image ?? get_static_option('no_image') }}" class="img-fluid img-thumbnail" alt="">
                </div>
            </div>
            <div class="row">
                <div class="portfolio-description">
                    <h2>{{ $blog->long_title }}</h2>
                    <p>
                        {!! $blog->long_description !!}
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('script')

@endpush

