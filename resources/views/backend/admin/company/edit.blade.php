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
                                    <input value="{{ $company->reporting_email }}" name="reporting_email" type="text"
                                        class="form-control" id="reporting_email" placeholder="Reporting email address">
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
                                    <img src="{{ asset($company->logo ?? get_static_option('no_image')) }}" alt=""
                                        width="70px" class="img-circle">
                                    <input name="logo" type="file" accept="image/*" class="form-control" id="logo"
                                        placeholder="logo">
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
                                    <input value="{{ get_static_option('sms_api_key') }}" name="sms_api_key" type="text"
                                        class="form-control" id="sms_api_key" placeholder="SMS API Key">
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
                                    <input value="{{ get_static_option('sms_api_pass') }}" name="sms_api_pass"
                                        type="text" class="form-control" id="sms_api_pass" placeholder="SMS API Password">
                                    @error('sms_api_pass')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="sms_api_pass" class="col-sm-2 col-form-label">SMS Content 1</label>
                                <div class="col-sm-10">
                                    <textarea name="regular_invoice_message_content_for_new_customer" id=""
                                        class="form-control" cols="10" rows="5">{!! get_static_option('regular_invoice_message_content_for_new_customer') !!}</textarea>
                                    <p class="text-danger">
                                        <code>[sender_name]
                                            [custom_counter]
                                            [receiver_phone]
                                            [receiver_password]</code>
                                    </p>
                                    <b class="text-success">
                                        <b>রফিক স্টোর থেকে আপনার মাল নিউ শাপলা ট্রান্সপোর্টে বুকিং করা হয়েছে। বুকিং নং-
                                            ১০ লগিন করে মালামালের অবস্থান জানতে ব্যবহার করুন মোবাইলঃ 01304734623 এবং
                                            পাসওয়ার্ডঃ 123456 লিংকঃ www.nsta.com.bd</b>
                                    </b>
                                    <br>
                                    <br>
                                    <h4> উপরে উল্লেখিত ফরমেটে মেসেজ পাঠানোর জন্য নিম্নে একটি উদাহরণ দেয়া হলো:</h4>
                                    <code>[sender_name] থেকে আপনার মাল নিউ শাপলা ট্রান্সপোর্টে বুকিং করা হয়েছে। বুকিং
                                        নং- [custom_counter] লগিন করে মালামালের অবস্থান জানতে ব্যবহার করুন মোবাইলঃ
                                        [receiver_phone] এবং পাসওয়ার্ডঃ [receiver_password] লিংকঃ
                                        www.nsta.com.bd</code>
                                    @error('regular_invoice_message_content_for_new_customer')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="sms_api_pass" class="col-sm-2 col-form-label">SMS Content 2</label>
                                <div class="col-sm-10">
                                    <textarea name="regular_invoice_message_content_for_old_customer" id=""
                                        class="form-control" cols="10" rows="5">{!! get_static_option('regular_invoice_message_content_for_old_customer') !!}</textarea>
                                    <p class="text-danger">
                                        <code>[sender_name]
                                            [custom_counter]</code>
                                    </p>
                                    <b class="text-success">
                                        <b>রফিক স্টোর থেকে আপনার মাল নিউ শাপলা ট্রান্সপোর্টে বুকিং করা হয়েছে। বুকিং নং-
                                            ১০ লগিন করে মালামালের অবস্থান জানতে আপনার মোবাইল নাম্বার এবং পাসওয়ার্ড
                                            ব্যবহার করুন। লিংকঃ www.nsta.com.bd</b>
                                    </b>
                                    <br>
                                    <br>
                                    <h4> উপরে উল্লেখিত ফরমেটে মেসেজ পাঠানোর জন্য নিম্নে একটি উদাহরণ দেয়া হলো:</h4>
                                    <code>[sender_name] থেকে আপনার মাল নিউ শাপলা ট্রান্সপোর্টে বুকিং করা হয়েছে। বুকিং
                                        নং- [custom_counter] লগিন করে মালামালের অবস্থান জানতে আপনার মোবাইল নাম্বার এবং
                                        পাসওয়ার্ড ব্যবহার করুন। লিংকঃ www.nsta.com.bd</code>
                                    @error('regular_invoice_message_content_for_old_customer')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <hr class="bg-success">
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Conditional Password</label>
                                <div class="col-sm-10">
                                    <input value="{{ get_static_option('conditional_password') }}" name="conditional_password" type="text" class="form-control"
                                        id="conditional_password" placeholder="Password for condition">
                                    @error('conditional_password')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <hr class="bg-success">
                            <div class="row">
                                <div class="col-3">
                                    <input type="text" name="invoice_number_1" value="{{ get_static_option('invoice_number_1') }}" placeholder="Serrial 1" class="form-control">
                                    <input type="text" name="invoice_number_2" value="{{ get_static_option('invoice_number_2') }}" placeholder="Serrial 2" class="form-control">
                                    <input type="text" name="invoice_number_3" value="{{ get_static_option('invoice_number_3') }}" placeholder="Serrial 3" class="form-control">
                                    <input type="text" name="invoice_number_4" value="{{ get_static_option('invoice_number_4') }}" placeholder="Serrial 4" class="form-control">
                                    <input type="text" name="invoice_number_5" value="{{ get_static_option('invoice_number_5') }}" placeholder="Serrial 5" class="form-control">
                                </div>
                                <div class="col-3">
                                    <input type="text" name="invoice_number_6" value="{{ get_static_option('invoice_number_6') }}" placeholder="Serrial 6" class="form-control">
                                    <input type="text" name="invoice_number_7" value="{{ get_static_option('invoice_number_7') }}" placeholder="Serrial 7" class="form-control">
                                    <input type="text" name="invoice_number_8" value="{{ get_static_option('invoice_number_8') }}" placeholder="Serrial 8" class="form-control">
                                    <input type="text" name="invoice_number_9" value="{{ get_static_option('invoice_number_9') }}" placeholder="Serrial 9" class="form-control">
                                    <input type="text" name="invoice_number_10" value="{{ get_static_option('invoice_number_10') }}" placeholder="Serrial 10" class="form-control">
                                </div>
                                <div class="col-3">
                                    <input type="text" name="invoice_number_11" value="{{ get_static_option('invoice_number_11') }}" placeholder="Serrial 11" class="form-control">
                                    <input type="text" name="invoice_number_12" value="{{ get_static_option('invoice_number_12') }}" placeholder="Serrial 12" class="form-control">
                                    <input type="text" name="invoice_number_13" value="{{ get_static_option('invoice_number_13') }}" placeholder="Serrial 13" class="form-control">
                                    <input type="text" name="invoice_number_14" value="{{ get_static_option('invoice_number_14') }}" placeholder="Serrial 14" class="form-control">
                                    <input type="text" name="invoice_number_15" value="{{ get_static_option('invoice_number_15') }}" placeholder="Serrial 15" class="form-control">
                                </div>
                                <div class="col-3">
                                    <input type="text" name="invoice_number_16" value="{{ get_static_option('invoice_number_16') }}" placeholder="Serrial 16" class="form-control">
                                    <input type="text" name="invoice_number_17" value="{{ get_static_option('invoice_number_17') }}" placeholder="Serrial 17" class="form-control">
                                    <input type="text" name="invoice_number_18" value="{{ get_static_option('invoice_number_18') }}" placeholder="Serrial 18" class="form-control">
                                    <input type="text" name="invoice_number_19" value="{{ get_static_option('invoice_number_19') }}" placeholder="Serrial 19" class="form-control">
                                    <input type="text" name="invoice_number_20" value="{{ get_static_option('invoice_number_20') }}" placeholder="Serrial 20" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button id="submit-btn" class="btn btn-primary mt-5">Update</button>
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
