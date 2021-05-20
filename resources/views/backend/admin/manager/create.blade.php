@push('title')
    Manager create
@endpush
@extends('layouts.backend.app')
@push('style')

@endpush
@section('breadcrumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Manager create</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Manager create</li>
                </ol>
                <a href="{{ route('admin.manager.index') }}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Back to list</a>
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
                <h5 class="card-title text-white">Manager create</h5>
            </div>
            <div class="card-body">
                <form class="row justify-content-center" method="POST" action="{{ route('admin.manager.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-lg-10">
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input value="{{ old('name') }}" name="name" type="text" class="form-control"
                                    id="name" placeholder="Name">
                                @error('name')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input value="{{ old('email') }}" name="email" type="email" class="form-control"
                                    id="email" placeholder="Email">
                                @error('email')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-10">
                                <input value="{{ old('phone') }}" name="phone" type="text" class="form-control"
                                    id="phone" placeholder="Phone">
                                @error('phone')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input value="{{ old('password') }}" name="password" type="text" class="form-control"
                                    id="password" placeholder="Password">
                                @error('password')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <select name="status" class="select2-single form-control">
                                    <option @if (old('status') == true) selected @endif value="1">Active </option>
                                    <option @if (old('status') == false) selected @endif value="0">Inactive </option>
                                </select>
                                @error('status')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="branch" class="col-sm-2 col-form-label">Branch</label>
                            <div class="col-sm-10">
                                <select name="branch" class="select2-single form-control">
                                    <option selected value=""> Chose branch </option>
                                    @foreach($branches as $branch)
                                    <option @if (old('branch') == $branch->id) selected @endif value="{{ $branch->id }}"> {{ $branch->name }} </option>
                                    @endforeach
                                </select>
                                @error('branch')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-10">
                                <input name="image" type="file" accept="image/*" class="form-control-lg" id="image">
                                @error('image')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button id="submit-btn" class="btn btn-primary">Save</button>
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
