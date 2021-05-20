<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User Profile-->
        @if(Auth::check())
            <div class="user-profile">
                <div class="user-pro-body">
                    <div><img src="{{ asset( auth()->user()->image ?? get_static_option('no_image') ) }}" alt="" class="img-circle"></div>
                    <div class="dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle u-dropdown link hide-menu"
                           data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ auth()->user()->name }}<span class="caret"></span></a>
                        <div class="dropdown-menu animated flipInY">
                            <!-- text-->
                            <a href="{{ route('backend.profile') }}" class="dropdown-item"><i class="ti-user"></i> আমার প্রোফাইল </a>
                            <!-- text-->
                            <div class="dropdown-divider"></div>
                            <!-- text-->
                            <a href="javascript:0" class="dropdown-item logout-btn"><i class="fas fa-power-off"></i> লগ আউট </a>
                            <!-- text-->
                        </div>
                    </div>
                </div>
            </div>
    @endif
    <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                @if (check_superadmin())
                    @include('layouts.backend.partials.left-site-bar.superadmin')
                @endif
                @if (check_admin())
                    @include('layouts.backend.partials.left-site-bar.admin')
                @endif
                @if (check_manager())
                    @include('layouts.backend.partials.left-site-bar.manager')
                @endif
                @if (check_customer())
                    @include('layouts.backend.partials.left-site-bar.customer')
                @endif
                <br>
                <br>
                <br>
                <br>
                <br>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
