<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <div class="navbar-header text-center">
            <a class="navbar-brand" href="{{ route('login') }}">
                <!-- Logo icon -->
                <b>{{ config('app.name') }}</b>
                <!--End Logo icon -->
            </a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav mr-auto">
                <!-- This is  -->
                <li class="nav-item"><a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark"
                                        href="javascript:void(0)"><i class="ti-menu"></i></a></li>
                <li class="nav-item"><a
                        class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark"
                        href="javascript:void(0)"><i class="icon-menu"></i></a></li>
                @if(auth()->user()->type == 'Manager')
                <li class="nav-item">
                    <div class="input-group mt-3">
                        <input type="text" class="form-control invoice-search-field" placeholder="ভাউচাার নাম্বার" aria-label="" aria-describedby="basic-addon1">
                        <div class="input-group-append">
                            <button class="btn btn-info show-invoice-use-btn" type="button" id="searched-invoice">সার্চ!</button>
                        </div>
                    </div>
                </li>
                @endif
                <!-- ============================================================== -->
            </ul>
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
            <ul class="navbar-nav my-lg-0">
                @if(auth()->user()->type == 'Manager')
                <li class="nav-item">
                    <div class="btn-toolbar nav-link" role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group mr-2" role="group" aria-label="First group" id="last-five-invoice">
                            <!--Insert by ajax-->
                            @foreach(auth()->user()->invoices()->orderBy('id', 'desc')->take(5)->get() as $inv)
                                <a type="button" target="_blank" class="btn btn-secondary text-danger" href="{{ route('manager.invoice.show', $inv) }}">{{ $inv->custom_counter }}</a>
                            @endforeach
                        </div>
                    </div>
                </li>
                @endif
                <li class="nav-item right-side-toggle">
                    <a class="nav-link  waves-effect waves-light" href="javascript:void(0)"><i class="ti-settings"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
