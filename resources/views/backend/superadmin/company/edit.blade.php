@push('title')
    Company edit
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
                    <li class="breadcrumb-item"><a href="{{ route('superadmin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Company edit</li>
                </ol>
                <a href="{{ route('superadmin.company.index') }}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Back to list</a>
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
                    <h5 class="card-title text-white">Company edit</h5>
                </div>
                <div class="card-body">
                    <form class="row justify-content-center" method="POST" action="{{ route('superadmin.company.update', $company) }}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="col-lg-10">
                            <div class="form-group row">
                                <label for="name" class="col-sm-4 col-form-label">Name</label>
                                <div class="col-sm-8">
                                    <input value="{{ $company->name }}" name="name" type="text" class="form-control"
                                           id="name" placeholder="Name">
                                    @error('name')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="status" class="col-sm-4 col-form-label">Admin</label>
                                <div class="col-sm-8">
                                    @foreach($company->admins as $ad) {{ $loop->iteration}}: {{ $ad->name ?? 'No name'}}, @endforeach
                                    <select name="admin" class="select2-single form-control">
                                        <option selected value="">Chose admin </option>
                                        @foreach($admins as $admin)
                                        <option @if($admin->id == old('admin')) selected @endif value="{{ $admin->id }}"> {{ $admin->name}} </option>
                                        @endforeach
                                    </select>
                                    @error('admin')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="status" class="col-sm-4 col-form-label">Status</label>
                                <div class="col-sm-8">
                                    <select name="status" class="select2-single form-control">
                                        <option @if ($company->status == true) selected @endif value="1">Active </option>
                                        <option @if ($company->status == false) selected @endif value="0">Inactive </option>
                                    </select>
                                    @error('status')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="logo" class="col-sm-4 col-form-label">Logo</label>
                                <div class="col-sm-8">
                                    <img height="70px;" width="70px;" class="rounded-circle" src="{{ asset($company->logo ?? get_static_option('no_image')) }}" alt="">
                                    <input name="logo" type="file" accept="image/*" class="form-control-lg" id="logo">
                                    @error('logo')
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
