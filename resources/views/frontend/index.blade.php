@extends('layouts.frontend.app')
@push('title') Home @endpush
@section('content')
    <section id="hero" class="d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
                    <h1>{{ get_static_option('banner_highlight') }}</h1>
                    <h2>{{ get_static_option('banner_description') }}</h2>
                    <div class="d-flex justify-content-center justify-content-lg-start">
                        <a href="#about" class="btn-get-started scrollto">Get Started</a>
                        <a href="{{ get_static_option('banner_url') ?? 'javascript:0' }}" class="glightbox btn-watch-video"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                    <img src="{{ asset(get_static_option('banner_image')) }}" class="img-fluid animated" alt="">
                </div>
            </div>
        </div>
    </section><!-- End Hero -->

    <main id="main">
        <!-- ======= Cliens Section ======= -->
        <section id="cliens" class="cliens section-bg">
            <div class="container">
                <div class="row" data-aos="zoom-in">
                    @foreach($partners as $partner)
                    <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                        <a href="{{ $partner->link }}" target="_blank"><img src="{{ asset($partner->image) ?? get_static_option('no_image') }}" class="img-fluid" alt=""></a>
                    </div>
                    @endforeach
                </div>
            </div>
        </section><!-- End Cliens Section -->

        <!-- ======= About Us Section ======= -->
        <section id="about" class="about">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>{{ get_static_option('about_title') }}</h2>
                </div>
                <div class="row content">
                    {!! get_static_option('about_description') !!}
                </div>
            </div>
        </section><!-- End About Us Section -->

        <!-- ======= Why Us Section ======= -->
        <section id="why-us" class="why-us">
            <div class="container-fluid" data-aos="fade-up">
                @foreach($home_contents as $home_content)
                <div class="row  @if($loop->odd) section-bg @endif">
                    <div class="col-lg-5 align-items-stretch order-1  @if($loop->odd) order-lg-2 @endif  img" style='background-image: url("{{ asset($home_content->image ?? get_static_option('no_image')) }}");' data-aos="zoom-in" data-aos-delay="150">&nbsp;</div>
                    <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">
                        <div class="content">
                            <h3><strong>{{ $home_content->title }}</strong></h3>
                            <p>
                                {!! $home_content->description !!}
                            </p>
                        </div>
                        <div class="accordion-list">
                            <ul>
                                @foreach($home_content->homeContentFaqs as $homeContentFaq)
                                <li>
                                    <a data-bs-toggle="collapse" class="collapse" data-bs-target="#accordion-list-{{ $home_content->id }}-{{ $loop->iteration }}"><span>{{ $loop->iteration }}</span> {{ $homeContentFaq->question }} <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                                    <div id="accordion-list-{{ $home_content->id }}-{{ $loop->iteration }}" class="collapse" data-bs-parent=".accordion-list">
                                        <p>
                                            {!!  $homeContentFaq->answer !!}
                                        </p>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
                @endforeach
            </div>
        </section><!-- End Why Us Section -->

        <!-- ======= Skills Section ======= -->
        <section id="skills" class="skills">
            <div class="container" data-aos="fade-up">
                <div class="row">
                    <div class="col-lg-6 d-flex align-items-center" data-aos="fade-right" data-aos-delay="100">
                        <img src="{{ asset(get_static_option('strength_image')) }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0 content" data-aos="fade-left" data-aos-delay="100">
                        <h3>{{ get_static_option('strength_title') }}</h3>
                        <p class="fst-italic">
                            {!! get_static_option('strength_description') !!}
                        </p>
                        <div class="skills-content">
                            @foreach($strengths as $strength)
                            <div class="progress">
                                <span class="skill">{{ $strength->name }} <i class="val">{{ $strength->percentage }}%</i></span>
                                <div class="progress-bar-wrap">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="{{ $strength->percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End Skills Section -->

        <!-- ======= Services Section ======= -->
        <section id="services" class="services section-bg">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>{{ get_static_option('service_title') }}</h2>
                    <p>{!! get_static_option('service_description') !!}</p>
                </div>
                <div class="row">
                    @foreach($services as $service)
                    <div class="col-xl-3 col-md-6 mb-4 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="{{ $loop->iteration }}00">
                        <div class="icon-box">
                            <div class="icon"><h1><b>{!! $service->icon !!}</b></h1></div>
                            <h4><a href="javascript:0">{{ $service->name }}</a></h4>
                            <p>{{ $service->description }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section><!-- End Services Section -->

        <!-- ======= Cta Section ======= -->
        <section id="cta" class="cta">
            <div class="container" data-aos="zoom-in">
                @foreach($callToActions as $callToAction)
                <div class="row">
                    <div class="col-lg-9 text-center text-lg-start">
                        <h3>{{ $callToAction->title }}</h3>
                        <p>
                            {!! $callToAction->description !!}
                        </p>
                    </div>
                    <div class="col-lg-3 cta-btn-container text-center">
                        <a class="cta-btn align-middle" target="_blank" href="{{ $callToAction->action_url ?? 'javascript:0' }}">{{ $callToAction->action_name }}</a>
                    </div>
                </div>
                <hr class="bg-danger">
                @endforeach
            </div>
        </section><!-- End Cta Section -->

        <!-- ======= Portfolio Section ======= -->
        <section id="portfolio" class="portfolio">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>{{ get_static_option('portfolio_title') }}</h2>
                    <p>{!! get_static_option('portfolio_description') !!}</p>
                </div>
                <ul id="portfolio-flters" class="d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
                    <li data-filter="*" class="filter-active">All</li>
                    @foreach($portfolioCategories as $portfolioCategory)
                    <li data-filter=".filter-{{ $portfolioCategory->id }}">{{ $portfolioCategory->name }}</li>
                    @endforeach
                </ul>
                <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
                    @foreach($portfolioCategories as $portfolioCategory)
                        @foreach($portfolioCategory->portfolios as $portfolio)
                            <div class="col-lg-4 col-md-6 portfolio-item filter-{{ $portfolioCategory->id }}">
                                <div class="portfolio-img"><img src="{{ asset($portfolio->images->first()->image ?? get_static_option('no_image')) }}" class="img-fluid" alt=""></div>
                                <div class="portfolio-info">
                                    <h4>{{ $portfolio->short_title }}</h4>
                                    <p>{{ $portfolioCategory->name }}</p>
                                    <a href="{{ asset($portfolio->images->first()->image ?? get_static_option('no_image')) }}" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="{{ $portfolio->name }}"><i class="bx bx-plus"></i></a>
                                    <a href="{{  url('/portfolio', $portfolio->slug) }}" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </section><!-- End Portfolio Section -->

        <!-- ======= Team Section ======= -->
        <section id="team" class="team section-bg">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>{{ get_static_option('team_title') }}</h2>
                    <p>{!! get_static_option('team_description') !!}</p>
                </div>
                <div class="row">
                    @foreach($teams as $team)
                    <div class="col-lg-6">
                        <div class="member d-flex align-items-start mb-3" data-aos="zoom-in" data-aos-delay="{{ $loop->iteration }}00">
                            <div class="pic"><img src="{{ asset($team->image ?? get_static_option('no_image')) }}" class="img-fluid" alt=""></div>
                            <div class="member-info">
                                <h4>{{ $team->name }}</h4>
                                <span>{{ $team->designation }}</span>
                                <p>{!! $team->note !!}</p>
                                <div class="social">
                                    <a href="{{ $team->twitter }}" target="_blank"><i class="ri-twitter-fill"></i></a>
                                    <a href="{{ $team->facebook }}" target="_blank"><i class="ri-facebook-fill"></i></a>
                                    <a href="{{ $team->instagram }}" target="_blank"><i class="ri-instagram-fill"></i></a>
                                    <a href="{{ $team->linkedin }}" target="_blank"> <i class="ri-linkedin-box-fill"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section><!-- End Team Section -->

        <!-- ======= Pricing Section ======= -->
        <section id="pricing" class="pricing">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>{{ get_static_option('price_title') }}</h2>
                    <p>{!! get_static_option('price_description') !!}</p>
                </div>

                <div class="row">
                    @foreach($prices as $price)
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration }}00">
                        <div class="box @if($loop->even) featured @endif">
                            <h3>{{ $price->name }}</h3>
                            <h4><sup></sup>{{ $price->price }}<span>{{ $price->duration }}</span></h4>
                            <ul>
                                <li>
                                    {!! $price->description !!}
                                </li>
                            </ul>
                            <a href="{{ url('/price',$price->slug) }}" class="buy-btn">Get Started</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section><!-- End Pricing Section -->

        <!-- ======= Frequently Asked Questions Section ======= -->
        <section id="faq" class="faq section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>{{ get_static_option('faq_title') }}</h2>
                    <p>
                        {!! get_static_option('faq_description') !!}
                    </p>
                </div>

                <div class="faq-list">
                    <ul>
                        @foreach($faqs as $faq)
                        <li data-aos="fade-up" data-aos-delay="{{ $loop->iteration }}00">
                            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-{{ $loop->iteration }}" class="collapsed"><b>{{ $loop->iteration }})</b> &nbsp;{{ $faq->question }} <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                            <div id="faq-list-{{ $loop->iteration }}" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                   {!! $faq->answer !!}
                                </p>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </section><!-- End Frequently Asked Questions Section -->

        <!-- ======= Testimonial Section ======= -->
        <section id="testimonial" class="testimonial team section-bg">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>{{ get_static_option('testimonial_title') }}</h2>
                    <p>
                        {!! get_static_option('testimonial_description') !!}
                    </p>
                </div>
                <div class="row">
                    @foreach($testimonials as $testimonial)
                        <div class="col-lg-6">
                            <div class="member d-flex align-items-start mb-3" data-aos="zoom-in" data-aos-delay="{{ $loop->iteration }}00">
                                <div class="pic"><img src="{{ asset($testimonial->writer_avatar ?? get_static_option('no_image')) }}" class="img-fluid" alt=""></div>
                                <div class="member-info">
                                    <h4>{{ $testimonial->writer_name }}</h4>
                                    <span>{{ $testimonial->writer_designation }}</span>
                                    <i>"{!! $testimonial->speech !!}"</i>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section><!-- Testimonial Section -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>{{ get_static_option('message_title') }}</h2>
                    <p>
                        {!! get_static_option('message_description') !!}
                    </p>
                </div>

                <div class="row">

                    <div class="col-lg-5 d-flex align-items-stretch">
                        <div class="info">
                            <div class="address">
                                <i class="bi bi-geo-alt"></i>
                                <h4>Location:</h4>
                                <p>{{ get_static_option('company_address') }}</p>
                            </div>

                            <div class="email">
                                <i class="bi bi-envelope"></i>
                                <h4>Email:</h4>
                                <p>{{ get_static_option('company_email') }}</p>
                            </div>

                            <div class="phone">
                                <i class="bi bi-phone"></i>
                                <h4>Call:</h4>
                                <p>{{ get_static_option('company_phone') }}</p>
                            </div>
                            <iframe src="{{ get_static_option('map_link') }}" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
                        </div>

                    </div>

                    <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
                        <div  class="php-email-form" id="">
                            <form action="javascript:0" id="contact-form">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Your Name</label>
                                        <input type="text" name="name" class="form-control" id="name" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email">Your Email</label>
                                        <input type="email" class="form-control" name="email" id="email" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control" name="phone" id="phone" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="subject">Subject</label>
                                        <input type="text" class="form-control" name="subject" id="subject" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name">Message</label>
                                    <textarea id="message" class="form-control" name="message" rows="7" required></textarea>
                                </div>
                                <div class="my-3">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Your message has been sent. Thank you!</div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="send-message-button">Send Message</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End Contact Section -->
    </main><!-- End #main -->
@endsection
