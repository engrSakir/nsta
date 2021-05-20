@push('title')
    Branch edit
@endpush
@extends('layouts.backend.app')
@push('style')

@endpush
@section('breadcrumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Branch edit</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('superadmin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Branch edit</li>
                </ol>
                <a href="{{ route('superadmin.branch.index') }}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Back to list</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <!-- Row -->
        <div class="row">
            <div class="card m-b-30 col-12 ">
                <div class="card-header bg-danger">
                    <h5 class="card-title text-white">Branch edit</h5>
                </div>
                <div class="card-body">
                    <form class="row justify-content-center" method="POST" action="{{ route('superadmin.branch.update', $branch) }}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="col-lg-10">
                            <div class="form-group row">
                                <label for="name" class="col-sm-4 col-form-label">Name</label>
                                <div class="col-sm-8">
                                    <input value="{{ $branch->name }}" name="name" type="text" class="form-control"
                                           id="name" placeholder="Branch name">
                                    @error('name')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label">Email</label>
                                <div class="col-sm-8">
                                    <input value="{{ $branch->email }}" name="email" type="text" class="form-control"
                                           id="email" placeholder="Email address">
                                    @error('email')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="phone" class="col-sm-4 col-form-label">Phone</label>
                                <div class="col-sm-8">
                                    <input value="{{ $branch->phone }}" name="phone" type="text" class="form-control"
                                           id="phone" placeholder="phone">
                                    @error('phone')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="address" class="col-sm-4 col-form-label">Address</label>
                                <div class="col-sm-8">
                                    <input value="{{ $branch->address }}" name="address" type="text" class="form-control"
                                           id="address" placeholder="address">
                                    @error('address')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="sender_search_length" class="col-sm-4 col-form-label">Sender search length</label>
                                <div class="col-sm-8">
                                    <input value="{{ $branch->sender_search_length }}" name="sender_search_length" type="number" class="form-control"
                                           id="sender_search_length" placeholder="Sender search length">
                                    @error('sender_search_length')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="receiver_search_length" class="col-sm-4 col-form-label">Receiver search length</label>
                                <div class="col-sm-8">
                                    <input value="{{ $branch->receiver_search_length }}" name="receiver_search_length" type="number" class="form-control"
                                           id="receiver_search_length" placeholder="Receiver search length">
                                    @error('receiver_search_length')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="global_search_length" class="col-sm-4 col-form-label">Global search length</label>
                                <div class="col-sm-8">
                                    <input value="{{ $branch->global_search_length }}" name="global_search_length" type="number" class="form-control"
                                           id="global_search_length" placeholder="Global search length">
                                    @error('global_search_length')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="status" class="col-sm-4 col-form-label">Status</label>
                                <div class="col-sm-8">
                                    <select name="status" id="status" class="select2-single form-control">
                                        <option @if ($branch->is_active == true) selected @endif value="1">Active </option>
                                        <option @if ($branch->is_active == false) selected @endif value="0">Inactive </option>
                                    </select>
                                    @error('status')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="head_office" class="col-sm-4 col-form-label">Head office</label>
                                <div class="col-sm-8">
                                    <select name="head_office" id="head_office" class="select2-single form-control">
                                        <option @if ($branch->is_head_office == true) selected @endif value="1">Yes </option>
                                        <option @if ($branch->is_head_office == false) selected @endif value="0">No </option>
                                    </select>
                                    @error('head_office')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="company" class="col-sm-4 col-form-label">Company</label>
                                <div class="col-sm-8">
                                    <select name="company" id="company" class="select2-single form-control">
                                        <option value="" selected disabled>Chose company</option>
                                        @foreach($companies as $company)
                                            <option @if ($branch->company_id == $company->id) selected @endif value="{{ $company->id }}"> {{ $company->name }} </option>
                                        @endforeach
                                    </select>
                                    @error('company')
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
        <!-- Row -->
    </div>
    <!-- End Contentbar -->
@endsection
@push('script')

@endpush
@push('summer-note')

@endpush
