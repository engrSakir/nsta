@push('title')
    Strength
@endpush
@extends('layouts.backend.app')
@push('style')
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@section('breadcrumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Strength</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Strength</li>
                </ol>
                <a href="{{ route('admin.strength.create') }}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create Strength</a>
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
                    <h5 class="card-title text-white">Strength list</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive color-bordered-table success-bordered-table">
                        <table id="datatable" class="display table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Percentage (%)</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                {{--Assign by ajax--}}
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Percentage (%)</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
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
                ajax: '{!! route('admin.strength.index') !!}',
                columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'percentage',
                    name: 'percentage'
                }, {
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

@endpush
