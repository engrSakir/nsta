@push('title')
    Profile
@endpush
@extends('layouts.backend.app')
@push('style')

@endpush
@section('breadcrumb')

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Profile</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
            {{--  <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button>  --}}
        </div>
    </div>
</div>
@endsection
@section('content')
<!-- Start Page Content -->
<!-- ============================================================== -->
<!-- Row -->
<div class="row">
    <!-- Column -->
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card">
            <div class="card-body">
                <center class="m-t-30"> <img src="{{ asset( auth()->user()->image ?? get_static_option('no_image') ) }}" class="img-circle" width="150">
                    <h4 class="card-title m-t-10">{{  auth()->user()->name }}</h4>
                    <h6 class="card-subtitle">{{  auth()->user()->email }}</h6>
                </center>
            </div>
            <div>
                <hr> </div>
            <div class="card-body">
                <small class="text-muted p-t-30 db">Phone</small>
                <h6>{{  auth()->user()->phone ?? '' }}</h6>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-8 col-xlg-9 col-md-7">
        <div class="card">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs profile-tab" role="tablist">
                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#profile" role="tab">Profile</a> </li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#password" role="tab">Password</a> </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <!--second tab-->
                <div class="tab-pane active" id="profile" role="tabpanel">
                    <div class="card-body">
                        <form class="form-horizontal form-material" action="{{ route('backend.profileInfoUpdate') }}" method="POST" enctype="multipart/form-data" >
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" value="{{ auth()->user()->name ?? '' }}" class="form-control" id="name" placeholder="Name">
                                     @error('name')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" value="{{ auth()->user()->email ?? '' }}" name="email" class="form-control" id="email" placeholder="Email">
                                     @error('email')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="phone">Phone</label>
                                    <input type="text" value="{{ auth()->user()->phone ?? '' }}" name="phone" class="form-control" id="phone" placeholder="Phone">
                                     @error('phone')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="address">Username</label>
                                    <input type="text" value="{{ auth()->user()->username ?? '' }}" name="username" class="form-control" id="username" placeholder="Username">
                                     @error('username')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="avatar">Avatar</label>
                                    <input type="file"  accept="image/*"  name="avatar" class="form-control" id="avatar">
                                     @error('avatar')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Update</button>
                        </form>
                    </div>
                </div>
                <div class="tab-pane" id="password" role="tabpanel">
                    <div class="card-body">
                        <form class="form-horizontal form-material" action="{{ route('backend.profilePasswordUpdate') }}" method="POST" >
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="old_password">Old Password</label>
                                    <input type="password" name="old_password" value="{{ old('old_password') }}" class="form-control" id="old_password">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password">Password</label>
                                    <input type="password" value="{{ old('password') }}" name="password" class="form-control" id="password">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password_confirmation">Confirmed Password</label>
                                    <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control" id="password_confirmation">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
</div>
<!-- Row -->
<!-- ============================================================== -->
<!-- End PAge Content -->
@endsection
@push('script')

@endpush
