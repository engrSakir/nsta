<!-- Summer note JS -->
@stack('summer-note')
<!-- Start JS -->
<script src="{{ asset('assets/backend/node_modules/jquery/jquery-3.2.1.min.js') }}"></script>
<!-- Bootstrap popper Core JavaScript -->
<script src="{{ asset('assets/backend/node_modules/popper/popper.min.js') }}"></script>
<script src="{{ asset('assets/backend/node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{ asset('assets/backend/dist/js/perfect-scrollbar.jquery.min.js') }}"></script>
<!--Wave Effects -->
<script src="{{ asset('assets/backend/dist/js/waves.js') }}"></script>
<!--Menu sidebar -->
<script src="{{ asset('assets/backend/dist/js/sidebarmenu.js') }}"></script>
<!--stickey kit -->
<script src="{{ asset('assets/backend/node_modules/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
<script src="{{ asset('assets/backend/node_modules/sparkline/jquery.sparkline.min.js') }}"></script>
<!--Custom JavaScript -->
<script src="{{ asset('assets/backend/dist/js/custom.min.js') }}"></script>
<!-- ============================================================== -->
<script src="{{ asset('assets/helpers/helper.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@include('sweetalert::alert')
<!-- Page JS -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@stack('script')


