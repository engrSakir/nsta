@push('title')
    Portfolio edit
@endpush
@extends('layouts.backend.app')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/dropzone-5.9.2/dropzone.css') }}" />
    <script src="{{ asset('assets/dropzone-5.9.2/dropzone.js') }}"></script>
    <style>
        #dropzone .message {
            font-family: "Segoe UI Light", "Arial", serif;
            font-weight: 600;
            color: #ec2209;
            font-size: 2.5em;
            letter-spacing: 0.05em;
        }

        .dropzone {
            border: 2px dashed #0087F7;
            background: white;
            border-radius: 5px;
            min-height: 200px;
            padding: 90px 0;
            vertical-align: baseline;
        }
    </style>
@endpush
@section('breadcrumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Portfolio edit</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('superadmin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Portfolio edit</li>
                </ol>
                <a href="{{ route('superadmin.portfolio.index') }}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Back to list</a>
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
                <h5 class="card-title text-white">Portfolio edit</h5>
            </div>
            <div class="card-body">
                <form class="row justify-content-center" method="POST" action="{{ route('superadmin.portfolio.update', $portfolio) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="col-lg-10">
                        <div class="form-group row">
                            <label for="short_title" class="col-sm-4 col-form-label">Short title</label>
                            <div class="col-12">
                                <input name="short_title" type="text" class="form-control" id="short_title" value=" {{ $portfolio->short_title }}">
                                @error('short_title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="long_title" class="col-sm-4 col-form-label">Long title</label>
                            <div class="col-12">
                                <input name="long_title" type="text" class="form-control" id="long_title" value=" {{ $portfolio->long_title }}">
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
                                        <option @if($portfolio->category_id == $portfolioCategory->id) selected @endif  value="{{ $portfolioCategory->id }}">{{ $portfolioCategory->name }}</option>
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
                                    <option @if ($portfolio->is_active == true) selected @endif value="1">Active </option>
                                    <option @if ($portfolio->is_active == false) selected @endif value="0">Inactive </option>
                                </select>
                                @error('status')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="short_description" class="col-sm-4 col-form-label">Short description</label>
                            <div class="col-12">
                                <textarea name="short_description" type="text" class="form-control description" id="short_description">{!! $portfolio->short_description !!}</textarea>
                                @error('short_description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="long_description" class="col-sm-4 col-form-label">Long description</label>
                            <div class="col-12">
                                <textarea name="long_description" type="text" class="form-control description" id="long_description">{!! $portfolio->long_description !!}</textarea>
                                @error('long_description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button id="submit-btn" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
                <br>
                <hr class="bg-danger mb-3">
                <form method="post" action="{{ route('superadmin.addPortfolioImages', $portfolio) }}" enctype="multipart/form-data"
                      class="dropzone" id="dropzone">
                    @csrf
                    @method('PATCH')
                    <div class="dz-message">
                        <div class="col-xs-8">
                            <div class="message">
                                <p>Drop images here or Click to Upload</p>
                            </div>
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
    <script type="text/javascript">
        $('.description').summernote({
            placeholder: 'Write a description ....',
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

        Dropzone.options.dropzone =
            {
                init: function() {
                    myDropzone = this;
                    var portfolio = {{ $portfolio->id }}
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: '{{ route('superadmin.getPortfolioImages') }}',
                        type: 'POST',
                        data: {portfolio: portfolio},
                        dataType: 'json',
                        success: function(response){
                            $.each(response, function(key,value) {
                                console.log(value.image)
                                var mockFile = { name: value.image, size: value.size};
                                myDropzone.displayExistingFile(mockFile, location.protocol + '//' + location.host + '/' + value.image);
                            });
                        }
                    });
                },

                maxFilesize: 12,
                renameFile: function (file) {
                    var dt = new Date();
                    var time = dt.getTime();
                    return time + file.name;
                },
                acceptedFiles: ".jpeg,.jpg,.png",
                addRemoveLinks: true,
                timeout: 50000,

                removedfile: function (file) {
                    if (file.upload){
                        var image = 'uploads/images/portfolio/'+file.upload.filename;
                    }else{
                        var image = file.name;
                    }
                    console.log(file);
                    console.log(image);
                    var portfolio = {{ $portfolio->id }};
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                       if (result.isConfirmed) {
                        $.ajax({
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            type: 'POST',
                            url: '{{ route("backend.removePortfolioImages") }}',
                            data: {image: image, portfolio: portfolio},
                            success: function (data) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted. '+data.message,
                                    'success'
                                )
                            },
                            error: function (xhr) {
                                var errorMessage = '<div class="card bg-danger">\n' +
                                    '                        <div class="card-body text-center p-5">\n' +
                                    '                            <span class="text-white">';
                                $.each(xhr.responseJSON.errors, function(key,value) {
                                    errorMessage +=(''+value+'<br>');
                                });
                                errorMessage +='</span>\n' +
                                    '                        </div>\n' +
                                    '                    </div>';
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    footer: errorMessage
                                });
                            },
                        });
                        var fileRef;
                        return (fileRef = file.previewElement) != null ?
                            fileRef.parentNode.removeChild(file.previewElement) : void 0;
                        }
                    });
                },
            };
    </script>
@endpush

