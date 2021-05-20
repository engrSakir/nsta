@extends('layouts.frontend.app')
@push('title') Images @endpush
@push('style')
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
@endpush
@section('content')
    <section id="hero" class="d-flex align-items-center" style="height: 350px">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center" data-aos-delay="100">
                    <h1>Gallery</h1>
                    <h2><a href="{{ url('/') }}">Home</a></h2>
                </div>
            </div>
        </div>
    </section><!-- End Hero -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">
            <div class="row">
                <div class="portfolio-description">
                    <div class="w3-row-padding">
                        @foreach($images as $image)
                        <div class="w3-container w3-third mb-3">
                            <img src="{{ $image->image ?? get_static_option('no_image') }}" style="width:100%;cursor:pointer"
                                 onclick="onClick(this)" class="w3-hover-opacity">
                        </div>
                        @endforeach
                    </div>

                    <div id="modal01" class="w3-modal" onclick="this.style.display='none'">
                        <span class="w3-button w3-hover-red w3-xlarge w3-display-topright">&times;</span>
                        <div class="w3-modal-content w3-animate-zoom">
                            <img id="img01" style="width:100%">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script>
        function onClick(element) {
            document.getElementById("img01").src = element.src;
            document.getElementById("modal01").style.display = "block";
        }
    </script>
@endpush

