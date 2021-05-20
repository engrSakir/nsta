<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.frontend.includes.head')
</head>
<body>
@include('layouts.frontend.includes.header')
<!-- ======= Content ======= -->
@yield('content')
@include('layouts.frontend.includes.footer')
<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
@include('layouts.frontend.includes.foot')
</body>
</html>
