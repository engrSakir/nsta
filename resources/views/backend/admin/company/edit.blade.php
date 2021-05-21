@push('title')
    Branch edit
@endpush
@extends('layouts.backend.app')
@push('style')

@endpush
@section('breadcrumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Company edit</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Company edit</li>
                </ol>
                <a href="{{ route('admin.branch.index') }}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Back to list</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <!-- Start row -->
        <div class="row">
            <div class="card m-b-30 col-12 ">
                <div class="card-header bg-danger">
                    <h5 class="card-title text-white">{{ $company->name }} &nbsp; update</h5>
                </div>
                <div class="card-body">
                    <form class="row justify-content-center" method="POST" action="{{ route('admin.company.update') }}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="col-lg-10">
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input value="{{ $company->name }}" name="name" type="text" class="form-control"
                                           id="name" placeholder="Branch name">
                                    @error('name')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="reporting_email" class="col-sm-2 col-form-label">Reporting Email</label>
                                <div class="col-sm-10">
                                    <input value="{{ $company->reporting_email }}" name="reporting_email" type="text" class="form-control"
                                           id="reporting_email" placeholder="Reporting email address">
                                    @error('reporting_email')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="logo" class="col-sm-2 col-form-label">Logo</label>
                                <div class="col-sm-10">
                                    <img src="{{ asset($company->logo ?? get_static_option('no_image')) }}" alt="" width="70px" class="img-circle">
                                    <input name="logo" type="file" accept="image/*" class="form-control"
                                           id="logo" placeholder="logo">
                                    @error('logo')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <hr class="bg-success">
                            <div class="form-group row">
                                <label for="sms_api_key" class="col-sm-2 col-form-label">SMS API Key</label>
                                <div class="col-sm-10">
                                    <input value="{{ get_static_option('sms_api_key') }}" name="sms_api_key" type="text" class="form-control"
                                           id="sms_api_key" placeholder="SMS API Key">
                                    @error('sms_api_key')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="sms_api_pass" class="col-sm-2 col-form-label">SMS API Password</label>
                                <div class="col-sm-10">
                                    <input value="{{ get_static_option('sms_api_pass') }}" name="sms_api_pass" type="text" class="form-control"
                                           id="sms_api_pass" placeholder="SMS API Password">
                                    @error('sms_api_pass')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button id="submit-btn" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End row -->
    </div>
    <!-- End Contentbar -->
@endsection
@push('script')

@endpush
@push('summer-note')

@endpush
