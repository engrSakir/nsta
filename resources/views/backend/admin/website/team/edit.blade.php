@push('title')
    Team edit
@endpush
@extends('layouts.backend.app')
@push('style')

@endpush
@section('breadcrumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Team edit</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Team edit</li>
                </ol>
                <a href="{{ route('admin.team.index') }}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Back to list</a>
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
                <h5 class="card-title text-white">Team edit</h5>
            </div>
            <div class="card-body">
                <form class="row justify-content-center" method="POST" action="{{ route('admin.team.update', $team) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="col-lg-10">
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label">Name <b class="text-danger">*</b></label>
                            <div class="col-12">
                                <input name="name" type="text" class="form-control" id="name" value="{{ $team->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-sm-4 col-form-label">Image</label>
                            <div class="col-12">
                                <input name="image" type="file" accept="image/*" class="form-control" id="image" value="{{ $team->image }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="designation" class="col-sm-4 col-form-label">Designation</label>
                            <div class="col-12">
                                <input name="designation" type="text" class="form-control" id="designation" value="{{ $team->designation }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="note" class="col-sm-4 col-form-label">Note</label>
                            <div class="col-12">
                                <textarea name="note" type="note" class="form-control" id="description">{!! $team->note  !!} </textarea>
                            </div>
                        </div>
                        <hr class="bg-success">
                        <div class="form-group row">
                            <label for="twitter" class="col-sm-4 col-form-label">Twitter</label>
                            <div class="col-12">
                                <input name="twitter" type="text" class="form-control" id="twitter" value="{{ $team->twitter }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="linkedin" class="col-sm-4 col-form-label">LinkedIn</label>
                            <div class="col-12">
                                <input name="linkedin" type="text" class="form-control" id="linkedin" value="{{ $team->linkedin }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="facebook" class="col-sm-4 col-form-label">Facebook</label>
                            <div class="col-12">
                                <input name="facebook" type="text" class="form-control" id="facebook" value="{{ $team->facebook }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="instagram" class="col-sm-4 col-form-label">Instagram</label>
                            <div class="col-12">
                                <input name="instagram" type="text" class="form-control" id="instagram" value="{{ $team->instagram }}">
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button id="submit-btn" class="btn btn-primary">Update</button>
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
