@push('title')
    Strength
@endpush
@extends('layouts.backend.app')
@push('style')

@endpush
@section('breadcrumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Strength</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('superadmin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Strength</li>
                </ol>
                <a href="{{ route('superadmin.strength.index') }}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Strength list</a>
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
                    <h5 class="card-title text-white">Strength</h5>
                </div>
                <div class="card-body">
                    <form class="row justify-content-center" method="POST" action="{{ route('superadmin.strengthUpdate') }}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="col-lg-10">
                            <div class="form-group row">
                                <label for="image" class="col-sm-4 col-form-label">Image</label>
                                <img height="70px;" width="70px;" class="rounded-circle" src="{{ asset(get_static_option('strength_image') ?? get_static_option('no_image')) }}" alt="">
                                <div class="col-12">
                                    <input name="image" type="file" accept="image/*" class="form-control" id="image" value="{{ get_static_option('strength_image') }}">
                                    @error('image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                            </div>
                            <div class="form-group row">
                                <label for="title" class="col-sm-4 col-form-label">Title</label>
                                <div class="col-12">
                                    <textarea name="title" type="text" class="form-control" id="title">{{ get_static_option('strength_title') }}</textarea>
                                    @error('title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-sm-4 col-form-label">Description</label>
                                <div class="col-12">
                                    <textarea name="description" type="text" class="form-control" id="description">{!! get_static_option('strength_description') !!}</textarea>
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
@push('summer-note')
    <script>
        $('#description').summernote({
            placeholder: 'Hello stand alone ui',
            tabsize: 2,
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    </script>
@endpush
