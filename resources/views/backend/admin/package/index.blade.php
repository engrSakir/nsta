@push('title')
    Package
@endpush
@extends('layouts.backend.app')
@push('style')
    <link href="{{ asset('assets/backend/dist/css/pages/pricing-page.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/backend/dist/css/pages/ribbon-page.css') }}" rel="stylesheet">
@endpush
@section('breadcrumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Packages</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Packages</li>
                </ol>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <!-- Start row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row pricing-plan">
                            @foreach($packages as $package)
                            <div class="col-md-3 col-xs-12 col-sm-6 no-padding">
                                <div class="pricing-box m-2 bg-secondary">
                                    <div class="pricing-body b-l">
                                        <div class="pricing-header">
                                            <h4 class="price-lable text-white bg-warning"> Rating {{ $package->purchases->count() }}</h4>
                                            <h4 class="text-center">{{ $package->name }}</h4>
                                            <h2 class="text-center"><span class="price-sign">৳</span>{{ $package->price }}</h2>
                                            <hr class="bg-danger">
                                        </div>
                                        <div class="price-table-content">
                                            <div class="price-row bg-info rounded">
                                               <h3 class="text-white font-weight-bold"> Per {{ $package->duration }} day</h3>
                                            </div>
                                            <div class="price-row"> Branch {{ $package->branch }}</div>
                                            <div class="price-row"> Admin {{ $package->admin }}</div>
                                            <div class="price-row"> Manager {{ $package->manager }}</div>
                                            <div class="price-row"> Customer {{ $package->customer }}</div>
                                            <div class="price-row"> Invoice {{ $package->invoice }}</div>
                                            <div class="price-row"> Per SMS price {{ $package->price_per_message }}</div>
                                            <div class="price-row bg-cyan rounded text-white font-weight-bold">
                                                Free sms <i class="h2">{{ $package->free_sms }}</i>
                                            </div>
                                            <div class="price-row">
                                                <button class="btn btn-danger waves-effect waves-light m-t-20">Buy Now</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End row -->
    </div>
    <!-- End Contentbar -->
@endsection
@push('script')

@endpush
