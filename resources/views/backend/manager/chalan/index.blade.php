@push('title')
    এন্ট্রি চালান
@endpush
@extends('layouts.backend.app')
@push('style')

@endpush
@section('breadcrumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor font-weight-bold">এন্ট্রি চালান</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('manager.dashboard') }}">ড্যাশবোর্ড</a></li>
                    <li class="breadcrumb-item active">এন্ট্রি চালান</li>
                </ol>
                <a href="{{ route('manager.invoice.create') }}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> ভাউচার তৈরি</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">এন্ট্রি চালান তালিকা</h4>
{{--                    <h6 class="card-subtitle">Add class <code>.color-bordered-table .primary-bordered-table</code></h6>--}}
                    <div class="row button-group">
                        <div class="col-lg-1 col-md-2">
                            <button type="button" disabled class="btn waves-effect waves-light btn-block btn-info counter_display">0</button>
                        </div>
                        <div class="col-lg-2 col-md-4">
                            <button type="button" class="btn waves-effect waves-light btn-block btn-info select-all">সবগুলো পছন্দ</button>
                        </div>
                        <div class="col-lg-2 col-md-4">
                            <button type="button" class="btn waves-effect waves-light btn-block btn-success un-select-all">সবগুলো অপছন্দ</button>
                        </div>
                        <div class="col-lg-2 col-md-4">
                            <button type="button" class="btn waves-effect waves-light btn-block btn-danger delete-selected-all">পছন্দ গুলো ডিলেট</button>
                        </div>
                    </div>
                    <div class="invoice-table table-responsive">
                        <table class="table color-bordered-table primary-bordered-table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>তারিখ</th>
                                <th>ড্রাইভার</th>
                                <th>শাখা অফিস</th>
                                <th>প্রিন্ট/এডিট/ডিলিট</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($chalans as $chalan)
                            <tr>
                                <td>
                                    <label class="btn btn-info active">
                                        <div class="custom-control custom-checkbox mr-sm-2">
                                            <input type="checkbox" value="{{ $chalan->id }}" name="chalan" class="custom-control-input" id="chalan-{{ $loop->iteration }}">
                                            <label class="custom-control-label font-weight-bold" for="chalan-{{ $loop->iteration }}">#{{ $chalan->custom_counter }}</label>
                                        </div>
                                    </label>
                                </td>
                                <td>
                                    <b style="font-size: 18px;">{{ en_to_bn($chalan->created_at->format('d/m/Y')) ?? '' }}</b><br>

                                    <span class="badge badge-success">
                                       মোট ভাউচার:  {{ en_to_bn($chalan->invoices->count()) ?? '' }}
                                    </span>
                                </td>
                                <td style="font-size: 16px;">
                                    {{ $chalan->driver_name ?? '' }}<br>
                                    <b>{{ $chalan->driver_phone ?? '' }}<br>
                                    <span class="text-danger">গাড়ি নাম্বার: {{ $chalan->car_number }}</span><br></b>
                                </td>
                                <td style="font-size: 16px;">
                                    {{ $chalan->toBranch->name ?? '' }}
                                </td>
                                <td>
                                    <button type="button" class="btn btn-info btn-circle btn-lg show-chalan" value="{{ route('manager.chalan.show', $chalan) }}"><i class="mdi mdi-cloud-print"></i> </button>

                                    <button type="button" class="btn btn-danger btn-circle btn-lg" onclick="delete_function(this)" value="{{ route('manager.chalan.destroy', $chalan) }}"><i class="mdi mdi-delete-circle"></i> </button>
                                </td>
                            </tr>
                            @endforeach
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>তারিখ</th>
                                <th>ড্রাইভার</th>
                                <th>শাখা অফিস</th>
                                <th>প্রিন্ট/এডিট/ডিলিট</th>
                            </tr>
                            </thead>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function(){
            // Get current page and set current in nav
            $('input[type="checkbox"]').change(function() {
                $('.counter_display').html($("[name='chalan']:checked").length)
            });

            $('.select-all').click(function(event) {
                $('.counter_display').html($("[name='chalan']:checked").length)
            });

            $('.un-select-all').click(function(event) {
                $('.counter_display').html($("[name='chalan']:checked").length)
            });

            $(".show-chalan").click( function (){
                var html_embed_code = `<embed type="text/html" src="`+$(this).val()+`" width="750" height="500">`;
                $('#extra-large-modal-body').html(html_embed_code);
                $('#extra-large-modal-body').addClass( "text-center" );
                $('#extra-large-modal-title').text( "এন্ট্রি চালান" );
                $('#extra-large-modal').modal('show');
            });

            $(".delete-selected-all").click( function (){
                Swal.fire({
                    title: 'আপনি কি নিশ্চিত?',
                    text: "একবার ডিলিট করে ফেললে এটিকে আর ফিরিয়ে আনতে পারবেন না!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#74051e',
                    cancelButtonColor: '#aad9e2',
                    confirmButtonText: 'হ্যাঁ ডিলিট হোক!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        if($('.invoice-table input:checkbox[name=chalan]:checked').length < 1){
                            alert('দয়া করে কিছু সংখ্যক চালান পছন্দ করুন।');
                        }else{
                            var chalans = []
                            $('.invoice-table input:checkbox[name=chalan]:checked').each(function()
                            {
                                chalans.push($(this).val())
                            });

                            var this_btn = $(this);
                            var formData = new FormData();
                            formData.append('chalans', chalans);
                            $.ajax({
                                method: 'POST',
                                url: '{{ route('manager.chalan.makeAsDeleted') }}',
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                data: formData,
                                processData: false,
                                contentType: false,
                                beforeSend: function (){
                                    //this_btn.html('Please wait ---- ');
                                    this_btn.prop("disabled",true);
                                },
                                complete: function (){
                                    //this_btn.html('Edit now');
                                    this_btn.prop("disabled",false);
                                },
                                success: function (data) {
                                    if (data.type == 'success'){
                                        Swal.fire({
                                            icon: data.type,
                                            title: 'ডিলিট !',
                                            text: data.message,
                                        });
                                        location.reload();
                                    }else{
                                        Swal.fire({
                                            icon: data.type,
                                            title: 'দুঃখিত...',
                                            text: data.message,
                                            footer: 'কোথাও কিছু একটা সমস্যা হয়েছে !'
                                        });
                                    }
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
                                        title: 'দুঃখিত...',
                                        footer: errorMessage
                                    });
                                },
                            });
                        }
                    }
                })
            });
        });
    </script>
@endpush
