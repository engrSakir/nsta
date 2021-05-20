<!-- ======= Footer ======= -->
<footer id="footer">

    <div class="footer-newsletter">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <h2>{{ get_static_option('subscriber_title') }}</h2>
                    <p>
                        {!! get_static_option('subscriber_description') !!}
                    </p>
                    <form action="javascript:0" method="">
                        <input type="email"  id="subscribe-email"  name="email"><input class="subscribe-now-btn" type="submit" value="Subscribe">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6 footer-contact">
                    <h3>{{ config('app.name') }}</h3>
                    <p>
                       {{ get_static_option('company_address') }} <br><br>
                        <strong>Phone:</strong> {{ get_static_option('company_email') }}<br>
                        <strong>Email:</strong> {{ get_static_option('company_email') }}<br>
                    </p>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        @foreach(active_custom_pages() as $custom_page)
                            @if($loop->odd)
                            <li><i class="bx bx-chevron-right"></i> <a href="{{ url('/page', $custom_page->slug) }}">{{ $custom_page->name }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>More</h4>
                    <ul>
                        @foreach(active_custom_pages() as $custom_page)
                            @if($loop->even)
                            <li><i class="bx bx-chevron-right"></i> <a href="{{ url('/page', $custom_page->slug) }}">{{ $custom_page->name }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Our Social Networks</h4>
                    <p>{{ get_static_option('note_for_social_network') }}</p>
                    <div class="social-links mt-3">
                        <a href="{{ get_static_option('company_twitter_link') ?? 'javascript:0' }}" target="_blank" class="twitter"><i class="bx bxl-twitter"></i></a>
                        <a href="{{ get_static_option('company_facebook_link') ?? 'javascript:0' }}" target="_blank" class="facebook"><i class="bx bxl-facebook"></i></a>
                        <a href="{{ get_static_option('company_instagram_link') ?? 'javascript:0' }}" target="_blank" class="instagram"><i class="bx bxl-instagram"></i></a>
                        <a href="{{ get_static_option('company_linkedin_link') ?? 'javascript:0' }}" target="_blank" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                        <a href="{{ get_static_option('company_youtube_link') ?? 'javascript:0' }}" target="_blank" class="youtube"><i class="bx bxl-youtube"></i></a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container footer-bottom clearfix">
        <div class="copyright">
            {!! get_static_option('footer_credit') !!}
        </div>
        <div class="credits">
            &copy; {{ date('Y') }} Copyright <strong><span><a href="{{ url('/') }}">{{ config('app.name') }}</a></span></strong>
        </div>
    </div>
</footer><!-- End Footer -->
