@push('title')
    নিরাপত্তা
@endpush
@extends('layouts.backend.app')
@push('style')

@endpush
@section('breadcrumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">নিরাপত্তা</h4>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-6">
            <div class="card card-body">
                <div class="login-box card">
                    <div class="card-body">
                        <form class="form-horizontal form-material" id="loginform"
                            action="{{ route('manager.conditionPassword') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <div class="col-xs-12 text-center">
                                    <div class="user-thumb text-center"> <img alt="thumbnail" class="img-circle"
                                            width="100" src="{{ asset('assets/backend/images/lock.png') }}">
                                        <h3>নিরাপত্তা</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <input class="form-control" type="password" placeholder="Password" name="password" value="{{ old('password') }}">
                                    @error('password')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <div class="col-xs-12">
                                    <button
                                        class="btn btn-info btn-lg w-100 text-uppercase waves-effect waves-light text-white"
                                        type="submit">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>
        <div class="col-sm-3">
        </div>
    </div>
@endsection
@push('script')

@endpush
