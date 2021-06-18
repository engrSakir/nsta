@push('title')
    কাস্টমার লিস্ট
@endpush
@extends('layouts.backend.app')
@push('style')

@endpush
@section('breadcrumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor font-weight-bold">কাস্টমার</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('manager.dashboard') }}">ড্যাশবোর্ড</a></li>
                    <li class="breadcrumb-item active">কাস্টমার</li>
                </ol>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
{{--                    <h4 class="card-title">ভাউচার লিস্ট</h4>--}}
{{--                    <h6 class="card-subtitle">Add class <code>.color-bordered-table .primary-bordered-table</code></h6>--}}
                    {{ $customers->links() }}
                    <div class="invoice-table table-responsive">
                        <table class="table color-bordered-table primary-bordered-table text-center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>নাম</th>
                                <th>ফোন</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($customers as $customer)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->phone }}</td>
                                </tr>
                            @endforeach
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>তারিখ</th>
                                <th>অফিস</th>
                            </tr>
                            </thead>
                            </tbody>
                        </table>
                    </div>
                    {{ $customers->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')

@endpush
@push('summer-note')

@endpush
