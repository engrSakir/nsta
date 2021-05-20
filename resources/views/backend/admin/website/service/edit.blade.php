@push('title')
    Service edit
@endpush
@extends('layouts.backend.app')
@push('style')

@endpush
@section('breadcrumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Service edit</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Service edit</li>
                </ol>
                <a href="{{ route('admin.service.index') }}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Back to list</a>
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
                <h5 class="card-title text-white">Service edit</h5>
            </div>
            <div class="card-body">
                <form class="row justify-content-center" method="POST" action="{{ route('admin.service.update', $service) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="col-lg-10">
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label">Name</label>
                            <div class="col-12">
                                <input name="name" type="text" class="form-control" id="name" value="{{ $service->name }}">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="icon" class="col-sm-4 col-form-label">Icon code (Right click on mouse and chose emoji ...)</label>
                            <div class="col-12">
                                <input name="icon" type="text" class="form-control" id="icon" value=" {{ $service->icon }}">
                                @error('icon')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-sm-4 col-form-label">Description</label>
                            <div class="col-12">
                                <textarea name="description" type="text" class="form-control" id="description">{{ $service->description }}</textarea>
                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
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
