@push('title')
    Dashboard
@endpush
@extends('layouts.backend.app')
@push('style')

@endpush
@section('breadcrumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Dashboard</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <a href="{{ url('/') }}" target="_blank" type="button" class="btn btn-info d-none d-lg-block m-l-15">
                    <i class="mdi mdi-checkbox-multiple-marked-circle"></i>
                    Website</a>
            </div>
        </div>
    </div>
@endsection
@section('content')

    <div class="row">
        <!-- Column -->
        <div class="col-md-6 col-lg-4 col-xlg-2">
            <div class="card">
                <div class="box bg-info text-center">
                    <h1 class="font-light text-white">{{ $users }}</h1>
                    <h6 class="text-white">Users</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-4 col-xlg-2">
            <div class="card">
                <div class="box bg-info text-center">
                    <h1 class="font-light text-white">{{ $messages }}</h1>
                    <h6 class="text-white">Messages</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-4 col-xlg-2">
            <div class="card">
                <div class="box bg-info text-center">
                    <h1 class="font-light text-white">{{ $blogs }}</h1>
                    <h6 class="text-white">Blogs</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-4 col-xlg-2">
            <div class="card">
                <div class="box bg-info text-center">
                    <h1 class="font-light text-white">{{ $partners }}</h1>
                    <h6 class="text-white">Partners</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-4 col-xlg-2">
            <div class="card">
                <div class="box bg-primary text-center">
                    <h1 class="font-light text-white">{{ $home_contents }}</h1>
                    <h6 class="text-white">Home contents</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-4 col-xlg-2">
            <div class="card">
                <div class="box bg-success text-center">
                    <h1 class="font-light text-white">{{ $strengths }}</h1>
                    <h6 class="text-white">Strengths</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-4 col-xlg-2">
            <div class="card">
                <div class="box bg-dark text-center">
                    <h1 class="font-light text-white">{{ $services }}</h1>
                    <h6 class="text-white">Services</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-4 col-xlg-2">
            <div class="card">
                <div class="box bg-megna text-center">
                    <h1 class="font-light text-white">{{ $faqs }}</h1>
                    <h6 class="text-white">FAQ</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-4 col-xlg-2">
            <div class="card">
                <div class="box bg-warning text-center">
                    <h1 class="font-light text-white">{{ $callToActions }}</h1>
                    <h6 class="text-white">Call To Actions</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-4 col-xlg-2">
            <div class="card">
                <div class="box bg-success text-center">
                    <h1 class="font-light text-white">{{ $portfolioCategories }}</h1>
                    <h6 class="text-white">Portfolio Categories</h6>
                </div>
            </div>
        </div>

        <!-- Column -->
        <div class="col-md-6 col-lg-4 col-xlg-2">
            <div class="card">
                <div class="box bg-success text-center">
                    <h1 class="font-light text-white">{{ $portfolios }}</h1>
                    <h6 class="text-white">Portfolio</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-4 col-xlg-2">
            <div class="card">
                <div class="box bg-dark text-center">
                    <h1 class="font-light text-white">{{ $teams }}</h1>
                    <h6 class="text-white">Teams</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-4 col-xlg-2">
            <div class="card">
                <div class="box bg-megna text-center">
                    <h1 class="font-light text-white">{{ $prices }}</h1>
                    <h6 class="text-white">Prices Package</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-4 col-xlg-2">
            <div class="card">
                <div class="box bg-warning text-center">
                    <h1 class="font-light text-white">{{ $testimonials }}</h1>
                    <h6 class="text-white">Testimonials</h6>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')

@endpush
