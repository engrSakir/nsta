@push('title')
    Home content create
@endpush
@extends('layouts.backend.app')
@push('style')

@endpush
@section('breadcrumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Home content create</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('superadmin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Home content create</li>
                </ol>
                <a href="{{ route('superadmin.homeContent.index') }}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Back to list</a>
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
                <h5 class="card-title text-white">Home content create</h5>
            </div>
            <div class="card-body">
                <form class="row justify-content-center" method="POST" action="{{ route('superadmin.homeContentFaq.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-lg-10">
                        <div class="form-group row">
                            <label for="home_content" class="col-sm-4 col-form-label">Home content</label>
                            <div class="col-sm-8">
                                <select name="home_content" id="home_content" class="select2-single form-control">
                                    @foreach($home_contents as $home_content)
                                        <option @if (old('home_content') ==  $home_content->id) selected @endif value="{{ $home_content->id }}"> {{ $home_content->title }} </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="question" class="col-sm-4 col-form-label">Question</label>
                            <div class="col-sm-8">
                                <input value="{{ old('question') }}" name="question" type="text" class="form-control"
                                    id="question" placeholder="Question">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="answer" class="col-sm-4 col-form-label">Answer</label>
                            <div class="col-12">
                                <textarea name="answer" type="text" class="form-control" id="answer">
                                    {!! old('answer') !!}</textarea>
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
        $('#answer').summernote({
            placeholder: 'Hello stand alone ui',
            tabsize: 2,
            height: 100,
            toolbar: [
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
