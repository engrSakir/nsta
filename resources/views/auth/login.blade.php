@push('title')
    Login
@endpush
@extends('layouts.auth.app')
@push('style')

@endpush
@section('content')
    <section id="wrapper">
        <div class="login-register" style="background-image:url({{ asset('assets/backend/images/background/login-register.jpg') }});">
            <div class="login-box card">
                <div class="card-body">
                    <form class="form-horizontal form-material" id="loginform"  method="POST"   action="{{ route('login') }}">
                        @csrf
                        <h3 class="text-center m-b-20">Login</h3>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input id="email" name="email" @if(env('DEMO_MOOD') == "On") value="admin@gmail.com" @else value="{{ old('email') }}" @endif class="form-control" type="text" required="" autofocus placeholder="Email/Phone/Username">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input name="password" id="password" @if(env('DEMO_MOOD') == "On") value="password" @else value="{{ old('password') }}" @endif class="form-control" type="password" required=""  autocomplete="current-password"  placeholder="Password">
                            </div>
                        </div>
                        @if (Route::has('password.request'))
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="d-flex no-block align-items-center">
                                        <div class="ml-auto">
                                            <a href="{{ route('password.request') }}" id="to-recover" class="text-muted"><i
                                                    class="fas fa-lock m-r-5"></i> Forgot your password?</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="form-group text-center">
                            <div class="col-xs-12 p-b-20">
                                <button class="btn btn-block btn-lg btn-info btn-rounded" type="submit">Log In</button>
                            </div>
                        </div>
                        <div class="form-group m-b-0">
                            <div class="col-sm-12 text-center">
                                @if(Route::has('register'))
                                Don't have an account? <a href="{{ route('register') }}" class="text-info m-l-5"><b>Sign Up</b></a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('script')

@endpush
