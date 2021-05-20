@push('title')
    Branch
@endpush
@extends('layouts.backend.app')
@push('style')

@endpush
@section('breadcrumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Branch</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Branch</li>
                </ol>
                <a href="{{ route('admin.branch.create') }}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create Branch</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <!-- Start row -->
        <div class="row">
            @foreach($branches as $branch)
            <div class="col-md-6 border-top-0">
                <div class="card border-info">
                    <a href="{{ route('admin.branch.edit', $branch) }}">
                         <div class="card-header text-center bg-info">
                            <h4 class="m-b-0 text-white"> <b>{{ $branch->name }}</b> </h4>
                             @if($branch->is_active) <span class="badge badge-pill badge-success">Active</span> @else <span class="badge badge-pill badge-danger">Deactivated</span> @endif
                             @if($branch->is_head_office) <span class="badge badge-pill badge-success">Head Office</span> @endif
                        </div>
                    </a>
                    <div class="card-body">
                        <div class="row">
                            <!-- Column -->
                            <div class="col-12">
                                <div class="card">
                                    <div class="box bg-megna text-center">
                                        <h1 class="font-light text-white">{{ $branch->fromInvoices()->whereYear('created_at', '=', $year)->sum('paid') }}</h1>
                                        <h6 class="text-white">Paid  ({{ $year }}) </h6>
                                    </div>
                                </div>
                            </div>
                            <!-- Column -->
                            <div class="col-12">
                                <div class="card">
                                    <div class="box bg-danger text-center">
                                        <h1 class="font-light text-white">
                                            {{ $branch->fromInvoices()->whereYear('created_at', '=', $year)->sum(DB::raw('price + home + labour')) - $branch->fromInvoices()->whereYear('created_at', '=', date('Y'))->sum('paid') }}
                                        </h1>
                                        <h6 class="text-white">Unpaid ({{ $year }}) </h6>
                                    </div>
                                </div>
                            </div>
                            <!-- Column -->
                            <div class="col-md-6 col-lg-6 col-xlg-4">
                                <div class="card">
                                    <div class="box bg-info text-center">
                                        <h1 class="font-light text-white">{{ $branch->fromInvoices()->whereYear('created_at', '=', $year)->count() }}</h1>
                                        <h6 class="text-white">Invoice ({{ $year }}) </h6>
                                    </div>
                                </div>
                            </div>
                            <!-- Column -->
                            <div class="col-md-6 col-lg-6 col-xlg-4">
                                <div class="card">
                                    <div class="box bg-warning text-center">
                                        <h1 class="font-light text-white">{{ $branch->messages()->whereYear('created_at', '=', $year)->sum('message_count') }}</h1>
                                        <h6 class="text-white">Message ({{ $year }})</h6>
                                    </div>
                                </div>
                            </div>
                            <!-- Column -->
                            <div class="col-md-6 col-lg-6 col-xlg-4">
                                <div class="card">
                                    <div class="box bg-dark text-center">
                                        <h1 class="font-light text-white">{{ $branch->branchCustomers->count() }}</h1>
                                        <h6 class="text-white">Customer</h6>
                                    </div>
                                </div>
                            </div>
                            <!-- Column -->
                            <div class="col-md-6 col-lg-6 col-xlg-4">
                                <div class="card">
                                    <div class="box bg-success text-center">
                                        <h1 class="font-light text-white">{{ $branch->managers->count() }}</h1>
                                        <h6 class="text-white">Manager</h6>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- End row -->
    </div>
    <!-- End Contentbar -->
@endsection
@push('script')

@endpush
