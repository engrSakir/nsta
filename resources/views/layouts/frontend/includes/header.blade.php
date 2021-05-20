<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

        <h1 class="logo me-auto"><a href="{{ url('/') }}">{{ config('app.name') }}</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <a href="{{ url('/') }}" class="logo me-auto"><img src="{{ get_static_option('frontend_logo') ?? get_static_option('no_image') }}" alt="" class="img-fluid"></a>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                <li><a class="nav-link scrollto" href="#about">About</a></li>
                <li><a class="nav-link scrollto" href="#services">Services</a></li>
                <li><a class="nav-link scrollto" href="#portfolio">Portfolio</a></li>
                <li class="dropdown"><a href="#"><span>More</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a class="nav-link scrollto" href="#team">Team</a></li>
                        <li><a class="nav-link scrollto" href="#pricing">Pricing</a></li>
                        <li><a class="nav-link scrollto" href="#faq">FAQ</a></li>
                        <li><a class="nav-link scrollto" href="#testimonial">Testimonial</a></li>
                        <hr class="bg-success">
                        <li><a class="" href="{{ url('/blogs') }}">Blogs</a></li>
                        <li><a class="" href="{{ url('/gallery') }}">Gallery</a></li>
                    </ul>
                </li>
                <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                @guest
                    <li><a class="getstarted scrollto" href="{{ route('login') }}">Login</a></li>
                @else
                    <li><a class="getstarted scrollto" href="{{ route('login') }}">{{ 'My Panel' }}</a></li>
                @endguest
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->
