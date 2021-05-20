@push('title')
    Messages
@endpush
@extends('layouts.backend.app')
@push('style')

@endpush
@section('breadcrumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Messages</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Messages</li>
                </ol>
                <a href="{{ route('admin.websiteMessage.index') }}" class="btn btn-info d-none d-lg-block m-l-15"><i
                    class="fa fa-plus-circle"></i> Back to list</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <!-- Start row -->
        <div class="row justify-content-center">
            <!-- Start col -->
            <div class="card m-b-30 col-12 ">
                <div class="card-header bg-danger">
                    <h5 class="card-title text-white">Details</h5>
                </div>
                <div class="card-body">
                    <small class="text-muted">Name :</small>
                    <h6> {{ $websiteMessage->name }}</h6>
                    <small class="text-muted p-t-30 db">Phone :</small>
                    <h6>{{ $websiteMessage->phone }}</h6>
                    <small class="text-muted p-t-30 db">Email :</small>
                    <h6>{{ $websiteMessage->email }}</h6>
                    <small class="text-muted p-t-30 db">Status :</small>
                    @if($websiteMessage->is_process_complete == true)
                        <h6><span class="badge badge-success">Completed</span></h6>
                    @else
                        <h6><span class="badge badge-warning">Incomplete</span></h6>
                    @endif
                    <small class="text-muted p-t-30 db">Subject :</small>
                    <h6>{{ $websiteMessage->subject }}</h6>
                    <small class="text-muted p-t-30 db">Message :</small>
                    <h6>{{ $websiteMessage->message }}</h6>
                </div>
            </div>
            <div class="card m-b-30 col-12 ">
                <div class="card-header bg-danger">
                    <h5 class="card-title text-white">Send mail </h5>
                </div>
                <div class="card-body">
                    <form class="row justify-content-center" method="POST" action="{{ route('admin.websiteMessageReplyMail') }}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="col-lg-10">
                            <div class="form-group row">
                                <label for="description" class="col-sm-4 col-form-label"><h3><span class="badge badge-success">Send email to: &nbsp; {{ $websiteMessage->email }}</span></h3></label>
                                <div class="col-12">
                                    <input name="email" type="hidden" value="{{ $websiteMessage->email }}">
                                    <textarea name="description" type="text" class="form-control" id="description">
                                        <br><br><br><br><br><br><br><br><br>
                                        <hr class="bg-success">
                                        <hr class="bg-info">
                                        <h4><b>Reply message of,</b></h4>
                                        <div class="card-body">
                                        <small class="text-muted">Name :</small>
                                        <h6> {{ $websiteMessage->name }}</h6>
                                        <small class="text-muted p-t-30 db">Phone :</small>
                                        <h6>{{ $websiteMessage->phone }}</h6>
                                        <small class="text-muted p-t-30 db">Email :</small>
                                        <h6>{{ $websiteMessage->email }}</h6>
                                        <small class="text-muted p-t-30 db">Subject :</small>
                                        <h6>{{ $websiteMessage->subject }}</h6>
                                        <small class="text-muted p-t-30 db">Message :</small>
                                        <h6>{{ $websiteMessage->message }}</h6>
                                    </textarea>
                                    @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button id="submit-btn" class="btn btn-primary">Send mail</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End col -->
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
            placeholder: 'Write email description ....',
            tabsize: 2,
            height: 400,
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
