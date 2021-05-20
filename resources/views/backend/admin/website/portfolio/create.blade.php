@push('title')
    Portfolio create
@endpush
@extends('layouts.backend.app')
@push('style')

@endpush
@section('breadcrumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Portfolio create</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Portfolio create</li>
                </ol>
                <a href="{{ route('admin.portfolio.index') }}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Back to list</a>
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
                <h5 class="card-title text-white">Portfolio create</h5>
            </div>
            <div class="card-body">
                <form class="row justify-content-center" method="POST" action="{{ route('admin.portfolio.store') }}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="col-lg-10">
                        <div class="form-group row">
                            <label for="short_title" class="col-sm-4 col-form-label">Short title</label>
                            <div class="col-12">
                                <input name="short_title" type="text" class="form-control" id="short_title" value=" {{ old('short_title') }}">
                                @error('short_title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="long_title" class="col-sm-4 col-form-label">Long title</label>
                            <div class="col-12">
                                <input name="long_title" type="text" class="form-control" id="long_title" value=" {{ old('long_title') }}">
                                @error('long_title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="category" class="col-sm-4 col-form-label">Select Category</label>
                            <div class="col-12">
                                <select name="category" id="category"  class="form-control" >
                                    @foreach ($portfolioCategories as $portfolioCategory)
                                        <option @if(old('category') == $portfolioCategory->id)  selected @endif value="{{ $portfolioCategory->id }}">{{ $portfolioCategory->name }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-sm-4 col-form-label">Status</label>
                            <div class="col-12">
                                <select name="status" id="status"  class="form-control" >
                                    <option @if (old('status') == true) selected @endif value="1">Active </option>
                                    <option @if (old('status') == false) selected @endif value="0">Inactive </option>
                                </select>
                                @error('status')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="short_description" class="col-sm-4 col-form-label">Short description</label>
                            <div class="col-12">
                                <textarea name="short_description" type="text" class="form-control description" id="short_description">{!! old('short_description') !!}</textarea>
                                @error('short_description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="long_description" class="col-sm-4 col-form-label">Long description</label>
                            <div class="col-12">
                                <textarea name="long_description" type="text" class="form-control description" id="long_description">{!! old('long_description') !!}</textarea>
                                @error('long_description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-sm-4 col-form-label">Image</label>
                            <div class="col-12" >
                                <input name="image" type="file" accept="image/*" class="form-control" id="image">
                                @error('image')
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
        $('.description').summernote({
            placeholder: 'Short description ....',
            tabsize: 2,
            height: 300,
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

