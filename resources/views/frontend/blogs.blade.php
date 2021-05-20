@extends('layouts.frontend.app')
@push('title') {{ __('Blogs') }} @endpush
@section('content')
    <section id="hero" class="d-flex align-items-center" style="height: 350px">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center" data-aos-delay="100">
                    <h1>Blogs</h1>
                    <h2><a href="{{ url('/') }}">Home</a></h2>
                </div>
            </div>
        </div>
    </section><!-- End Hero -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">
            <div class="row justify-content-center">
                @foreach($blogs as $blog)
                    <div class="card overlay m-3 col-md-3 col-xl-3">
                        <img class="card-img-top" src="{{ $blog->image ?? get_static_option('no_image') }}" alt="">
                        <div class="card-body">
                            <h5 class="card-title">{{ $blog->title }}</h5>
                            <p class="card-text">{!! Str::limit($blog->description, 150)  !!}</p>
                        </div>
                        <div class="card-body text-center">
                            <a href="{{ url('/blog', $blog->slug) }}" class="card-link">Read more ....</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

