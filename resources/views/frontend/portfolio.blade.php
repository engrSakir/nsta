@extends('layouts.frontend.app')
@push('title') Portfolio @endpush
@section('content')
    <section id="hero" class="d-flex align-items-center" style="height: 350px">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center" data-aos-delay="100">
                    <h1>Portfolio</h1>
                    <h2><a href="{{ url('/') }}">Home</a>/Portfolio</h2>
                </div>
            </div>
        </div>
    </section><!-- End Hero -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-8">
                    <div class="portfolio-details-slider swiper-container swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events">
                        <div class="swiper-wrapper align-items-center" id="swiper-wrapper-8718cb126a05104c" aria-live="off" style="transform: translate3d(-2568px, 0px, 0px); transition-duration: 0ms;">
                            @foreach($portfolio->images as $image)
                            <div class="swiper-slide swiper-slide-prev" data-swiper-slide-index="{{ $loop->iteration }}" role="group" aria-label="3 / 5" style="width: 856px;">
                                <img src="{{ asset($image->image) }}" alt="">
                            </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets"><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 1"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 2"></span><span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0" role="button" aria-label="Go to slide 3"></span></div>
                        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
                </div>
                <div class="col-lg-4">
                    <div class="portfolio-info">
                        <h3>{{ $portfolio->short_title }}</h3>
                        {!! $portfolio->short_description !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="portfolio-description">
                    <h2>{{ $portfolio->long_title }}</h2>
                    <p>
                        {!! $portfolio->long_description !!}
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection

