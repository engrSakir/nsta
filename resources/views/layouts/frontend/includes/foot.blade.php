<!-- Vendor JS Files -->
<script src="{{ asset('assets/frontend/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('assets/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/frontend/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/frontend/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/frontend/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ asset('assets/frontend/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/frontend/vendor/waypoints/noframework.waypoints.js') }}"></script>
<!-- Template Main JS File -->
<script src="{{ asset('assets/frontend/js/main.js') }}"></script>
<!-- End JS -->
<script src="{{ asset('assets/helpers/helper.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@include('sweetalert::alert')
<!-- Page JS -->
@stack('script')
