@push('title')
    Gallery create
@endpush
@extends('layouts.backend.app')
@push('style')

@endpush
@section('breadcrumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Gallery create</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Gallery create</li>
                </ol>
                <a href="{{ route('admin.gallery.index') }}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Back to list</a>
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
                <h5 class="card-title text-white">Gallery create</h5>
            </div>
            <div class="card-body">
                <form class="row justify-content-center" method="POST" action="{{ route('admin.gallery.store') }}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="col-lg-10">
                        <div class="form-group row">
                            <label for="image" class="col-sm-4 col-form-label">Image</label>
                            <div class="col-sm-8">
                                <input name="image" type="file" accept="image/*" class="form-control-lg" id="image">
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
