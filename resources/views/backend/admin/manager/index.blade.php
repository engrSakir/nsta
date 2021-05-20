@push('title')
    Manager
@endpush
@extends('layouts.backend.app')
@push('style')

@endpush
@section('breadcrumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Manager</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Manager</li>
                </ol>
                <a href="{{ route('admin.manager.create') }}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create Manager</a>
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
            <div class="col-lg-12">
                <div class="card m-b-30">
                    <div class="card-header bg-danger">
                        <h5 class="card-title text-white">Manager </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive color-bordered-table success-bordered-table">
                            <table id="datatable" class="display table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Branch</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($managers as $manager)
                                       <tr>
                                           <td>{{ $loop->iteration }}</td>
                                           <td><img class="rounded-circle" height="30px;" width="30px;" src="{{ asset($manager->image ?? get_static_option('no_image')) }}" /></td>
                                           <td>{{ $manager->name }}</td>
                                           <td>{{ $manager->phone }}</td>
                                           <td>{{ $manager->email }}</td>
                                           <td>
                                               @if($manager->is_active)
                                               <span class="badge badge-pill badge-success">Active</span>
                                               @else
                                                   <span class="badge badge-pill badge-danger">Deactivated</span>
                                               @endif
                                           </td>
                                           <td>{{ $manager->branch->name }}</td>
                                           <td>
                                               <div class="btn-group">
                                                   <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                       <i class="ti-trash"></i>
                                                   </button>
                                                   <div class="dropdown-menu animated flipInY">
                                                       <a class="dropdown-item" href="{{ route('admin.manager.edit', $manager) }}">Edit</a>
                                                       <button class="dropdown-item" onclick="delete_function(this)" value="{{ route('admin.manager.destroy', $manager) }}">Delete</button>
                                                   </div>
                                               </div>
                                           </td>
                                       </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                         <th>Status</th>
                                        <th>Branch</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
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

@endpush
