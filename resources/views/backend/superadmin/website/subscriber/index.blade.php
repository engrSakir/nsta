@push('title')
    Subscriber
@endpush
@extends('layouts.backend.app')
@push('style')
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{ asset('assets/frontend/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
@endpush
@section('breadcrumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Subscriber</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('superadmin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Subscriber</li>
                </ol>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <!-- Start row -->
        <div class="row">
            <!-- Start col -->
            <div class="card m-b-30 col-12 ">
                <div class="card-header bg-danger">
                    <h5 class="card-title text-white">Subscriber list</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive color-bordered-table success-bordered-table">
                        <table id="datatable" class="display table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- data imported by ajax --}}
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Email</th>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End col -->
                        <!-- Start col -->
            <div class="card m-b-30 col-12 mb-3">
                <div class="card-header bg-info">
                    <h5 class="card-title text-white">Messages</h5>
                </div>
                <div class="card-body">
                    <form class="row justify-content-center" method="POST" action="{{ route('superadmin.subscriberUpdate') }}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="col-lg-10">
                            <div class="form-group row">
                                <label for="title" class="col-sm-4 col-form-label">Title</label>
                                <div class="col-12">
                                    <textarea name="title" type="text" class="form-control" id="title">{{ get_static_option('subscriber_title') }}</textarea>
                                    @error('title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-sm-4 col-form-label">Description</label>
                                <div class="col-12">
                                    <textarea name="description" type="text" class="form-control" id="description">{!! get_static_option('subscriber_description') !!}</textarea>
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
            <!-- End col -->
        </div>
        <!-- End row -->
    </div>
    <!-- End Contentbar -->
@endsection
@push('script')
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script>
        $(function() {
            $('#datatable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{!! route('superadmin.subscriber.index') !!}',
                columns: [{
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
                initComplete: function() {
                    this.api().columns().every(function() {
                        var column = this;
                        var input = document.createElement("input");
                        $(input).appendTo($(column.footer()).empty())
                            .on('change', function() {
                                column.search($(this).val(), false, false, true).draw();
                            });
                    });
                }
            });
        });

    </script>
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

