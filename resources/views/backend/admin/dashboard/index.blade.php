@push('title')
    Dashboard
@endpush
@extends('layouts.backend.app')
@push('style')

@endpush
@section('breadcrumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Admin Dashboard</h4>
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
        <!-- Column 1-->
        <div class="col-md-6 col-lg-4 col-xlg-2">
            <div class="card">
                <div class="box bg-info text-center">
                    <h1 class="font-light text-white">{{ $data['usable_message_amount'] }} </h1>
                    <h6 class="text-white"> মেসেজ </h6>
                </div>
            </div>
        </div>
        <!-- Column 2-->
        <div class="col-md-6 col-lg-4 col-xlg-2">
            <div class="card">
                <div class="box bg-info text-center">
                    <h1 class="font-light text-white">{{ $data['used_branch_amount'] }} <b>/</b> <small>{{ $data['permitted_branch_amount'] }}</small> </h1>
                    <h6 class="text-white">ব্রাঞ্চ</h6>
                </div>
            </div>
        </div>
        <!-- Column 3-->
        <div class="col-md-6 col-lg-4 col-xlg-2">
            <div class="card">
                <div class="box bg-info text-center">
                    <h1 class="font-light text-white">{{ $data['used_admin_amount'] }} <b>/</b> <small>{{ $data['permitted_admin_amount'] }}</small> </h1>
                    <h6 class="text-white">এডমিন</h6>
                </div>
            </div>
        </div>
        <!-- Column 4-->
        <div class="col-md-6 col-lg-4 col-xlg-2">
            <div class="card">
                <div class="box bg-info text-center">
                    <h1 class="font-light text-white">{{ $data['used_manager_amount'] }} <b>/</b> <small>{{ $data['permitted_manager_amount'] }}</small> </h1>
                    <h6 class="text-white">ম্যানেজার</h6>
                </div>
            </div>
        </div>
        <!-- Column 5-->
        <div class="col-md-6 col-lg-4 col-xlg-2">
            <div class="card">
                <div class="box bg-info text-center">
                    <h1 class="font-light text-white">{{ $data['used_customer_amount'] }} <b>/</b> <small>{{ $data['permitted_customer_amount'] }}</small> </h1>
                    <h6 class="text-white">কাস্টমার</h6>
                </div>
            </div>
        </div>
        <!-- Column 6-->
        <div class="col-md-6 col-lg-4 col-xlg-2">
            <div class="card">
                <div class="box bg-info text-center">
                    <h1 class="font-light text-white">{{ $data['used_invoice_amount'] }} <b>/</b> <small>{{ $data['permitted_invoice_amount'] }}</small> </h1>
                    <h6 class="text-white">ভাউচার</h6>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')

@endpush
