@push('title')
    ভাউচার লিস্ট
@endpush
@extends('layouts.backend.app')
@push('style')

@endpush
@section('breadcrumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor font-weight-bold">অবস্থা: {{ $status ?? '' }}/শাখা: {{ $branch_name ?? '' }}</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('manager.dashboard') }}">ড্যাশবোর্ড</a></li>
                    <li class="breadcrumb-item active">ভাউচার</li>
                </ol>
                <a href="{{ route('manager.invoice.create') }}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i>ভাউচার তৈরি</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <!-- Column 1-->
        @foreach($invoices->groupBy('to_branch_id') as $branch_id => $invoice_items)
        <div class="col-md-6 col-lg-4 col-xlg-2">
            <a href="{{ route('manager.invoice.statusAndBranchConstant', [\Illuminate\Support\Str::slug($status, '-'), $branch_id]) }}">
                <div class="card">
                    <div class="box bg-info text-center">
                        <h4 class="font-light text-white font-weight-bold"> {{ \App\Models\Branch::find($branch_id)->name ?? '#'}}</h4>
                        <h6 class="text-white"> ভাউচার: {{ en_to_bn($invoice_items->count()) }} </h6>
                        <h6 class="text-white">
                            মোট টাকা : {{ en_to_bn($invoice_items->sum('price') + $invoice_items->sum('home') + $invoice_items->sum('labour')) }}
                            <br>
                            বাকি টাকা : {{ en_to_bn($invoice_items->sum('price') + $invoice_items->sum('home') + $invoice_items->sum('labour') - $invoice_items->sum('paid')) }}
                            <br>
                            পরিশোধিত টাকা : {{ en_to_bn($invoice_items->sum('paid')) }}
                        </h6>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
{{--                    <h4 class="card-title">ভাউচার লিস্ট</h4>--}}
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
                        @if (Request::is('*/manager/invoice/status/received') || Request::is('*/manager/invoice/status/received/branch/*'))
                        <div class="col-lg-2 col-md-4">
                            <button type="button" class="btn waves-effect waves-light btn-block btn-info make-as-on-going-btn">মালামাল ট্রাকে উঠান</button>
                        </div>
                        @endif
                        @if (Request::is('*/manager/invoice/status/on-going') || Request::is('*/manager/invoice/status/on-going/branch/*'))
                        <div class="col-lg-2 col-md-4">
                            <button type="button" class="btn waves-effect waves-light btn-block btn-info make-as-delivered-btn">মালামাল পৌঁছে গেছে</button>
                        </div>
                        @endif
                        @if (Request::is('*/manager/condition-invoice'))
                        <div class="col-lg-2 col-md-4">
                            <button type="button" class="btn waves-effect waves-light btn-block btn-info make-as-break-btn">কন্ডিশন ভাঙ্গন</button>
                        </div>
                        @endif

                    </div>
                    {{ $invoices->links() }}
                    <div class="invoice-table table-responsive">
                        <table class="table color-bordered-table primary-bordered-table text-center">
                            <thead>
                            <tr>
                                <th>#</th>
                                @if (Request::is('*/manager/condition-invoice'))
                                    <th>
                                        অবস্থা
                                    </th>
                                @endif
                                <th>তারিখ</th>
                                <th>অফিস</th>
                                <th>প্রেরক</th>
                                @if (Request::is('*/manager/condition-invoice'))
                                    <th>
                                        প্রেরক ফোন
                                    </th>
                                @endif
                                <th>প্রাপক</th>
                                <th>প্রাপক মোবাইল</th>
                                <th>স্টাফ</th>
                                <th>
                                    <span class="badge badge-pill badge-danger">বাকি</span>
                                    <span class="badge badge-pill badge-success">পরিশোধিত</span>
                                    <span class="badge badge-pill badge-secondary">মোট</span>
                                </th>
                                @if (Request::is('*/manager/condition-invoice'))
                                    <th>
                                        <span class="badge badge-pill badge-danger">কন্ডিশন</span>
                                        <span class="badge badge-pill badge-success">চার্জ</span>
                                        <span class="badge badge-pill badge-secondary">মোট</span>
                                    </th>
                                @endif
                                <th>প্রিন্ট/এডিট/ডিলিট</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($invoices as $invoice)
                            <tr>
                                <td>
                                    <label class="btn btn-info active">
                                        <div class="custom-control custom-checkbox mr-sm-2">
                                            <input type="checkbox" value="{{ $invoice->id }}" name="invoice" class="custom-control-input" id="invoice-{{ $loop->iteration }}">
                                            <label class="custom-control-label font-weight-bold" for="invoice-{{ $loop->iteration }}"># {{ en_to_bn($invoice->custom_counter) }}</label>
                                        </div>
                                    </label>
                                    @if($invoice->chalan)
                                        <button type="button" class="btn btn-outline-success btn-rounded show-chalan" value="{{ route('manager.chalan.show', $invoice->chalan) }}">
                                            <i class="mdi mdi-receipt"></i>
                                            {{ $invoice->chalan->custom_counter ?? '--' }}
                                        </button>
                                        @else
                                        <button type="button" class="btn btn-outline-danger btn-rounded show-chalan" disabled value="">
                                            <i class="mdi mdi-receipt"></i>
                                            {{ '0' }}
                                        </button>
                                    @endif

                                </td>
                                @if (Request::is('*/manager/condition-invoice'))
                                    <td>
                                        {{ $invoice->status ?? '' }}
                                    </td>
                                @endif
                                <td>
                                    <b>{{ en_to_bn($invoice->created_at->format('d/m/Y')) }}</b><br>
                                </td>
                                <td>
                                    {{ $invoice->toBranch->name ?? '' }}
                                </td>
                                <td>{{ $invoice->sender_name ?? '' }}</td>
                                @if (Request::is('*/manager/condition-invoice'))
                                    <td>{{ $invoice->sender_phone ?? '' }}</td>
                                @endif
                                <td>
                                  {{ $invoice->receiver->name ?? '' }}
                                </td>
                                <td>
                                    {{ $invoice->receiver->phone ?? '' }}
                                </td>
                                <td>
                                    {{ $invoice->creator->name ?? '' }}
                                </td>
                                <td style="font-size: 16px;">
                                    <span class="badge badge-pill badge-danger">{{ en_to_bn($invoice->price + $invoice->home + $invoice->labour - $invoice->paid) }}</span>
                                    <span class="badge badge-pill badge-success">{{ en_to_bn($invoice->paid) }}</span>
                                    <span class="badge badge-pill badge-secondary">{{ en_to_bn($invoice->price + $invoice->home + $invoice->labour) }}</span>
                                </td>
                                @if (Request::is('*/manager/condition-invoice'))
                                    <td>
                                        <span class="badge badge-pill badge-danger">{{ en_to_bn($invoice->condition_amount) }}</span>
                                        <span class="badge badge-pill badge-success">{{ en_to_bn($invoice->condition_charge) }}</span>
                                        <span class="badge badge-pill badge-secondary">{{ en_to_bn($invoice->condition_amount + $invoice->condition_charge) }}</span>
                                    </td>
                                @endif
                                <td>
                                    <button type="button" class="btn btn-info btn-circle show-inv" value="{{ route('manager.invoice.show', $invoice) }}"><i class="mdi mdi-cloud-print"></i> </button>
                                    <button type="button" class="btn btn-warning btn-circle edit-inv" value="{{ route('manager.invoice.edit', $invoice) }}"><i class="mdi mdi-tooltip-edit"></i> </button>
                                    <button type="button" class="btn btn-danger btn-circle" onclick="delete_function(this)" value="{{ route('manager.invoice.destroy', $invoice) }}"><i class="mdi mdi-delete-circle"></i> </button>
                                </td>
                            </tr>
                            @endforeach
                            <thead>
                            <tr>
                                <th>#</th>
                                @if (Request::is('*/manager/condition-invoice'))
                                    <th>
                                        অবস্থা
                                    </th>
                                @endif
                                <th>তারিখ</th>
                                <th>অফিস</th>
                                <th>প্রেরক</th>
                                @if (Request::is('*/manager/condition-invoice'))
                                    <th>
                                        প্রেরক ফোন
                                    </th>
                                @endif
                                <th>প্রাপক</th>
                                <th>প্রাপক মোবাইল</th>
                                <th>স্টাফ</th>
                                <th>
                                    <span class="badge badge-pill badge-danger">বাকি</span>
                                    <span class="badge badge-pill badge-success">পরিশোধিত</span>
                                    <span class="badge badge-pill badge-secondary">মোট</span>
                                </th>
                                @if (Request::is('*/manager/condition-invoice'))
                                    <th>
                                        <span class="badge badge-pill badge-danger">কন্ডিশন</span>
                                        <span class="badge badge-pill badge-success">চার্জ</span>
                                        <span class="badge badge-pill badge-secondary">মোট</span>
                                    </th>
                                @endif
                                <th>প্রিন্ট/এডিট/ডিলিট</th>
                            </tr>
                            </thead>
                            </tbody>
                        </table>
                    </div>
                    {{ $invoices->links() }}
                </div>
            </div>
        </div>
        @if (Request::is('*/manager/invoice/status/received') || Request::is('*/manager/invoice/status/received/branch/*'))
        <!-- inv large modal -->
        <div class="modal bs-example-modal-lg" id="inv-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="inv-modal-title">
                            {{-- Assign by ajax--}}
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body" id="inv-modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mt-4">
                                            <div class="form-group">
                                                <label for="branch-office">ব্রাঞ্চ অফিস</label>
                                                <select class="form-control custom-select" id="branch-office">
                                                    <option selected value="">--Select your branch office--</option>
                                                    @foreach($invoices->groupBy('to_branch_id') as $branch_id => $invoice_items)
                                                        <option value="{{ $branch_id }}">{{ \App\Models\Branch::find($branch_id)->name ?? '#'}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="driver-name">ড্রাইভারের নাম </label>
                                                <input type="text" class="form-control" id="driver-name" placeholder="Driver name">
                                            </div>
                                            <div class="form-group">
                                                <label for="driver-phone">ড্রাইভারের ফোন</label>
                                                <input type="text" class="form-control" id="driver-phone" placeholder="Driver phone">
                                            </div>
                                            <div class="form-group">
                                                <label for="car-number">গাড়ির নাম্বার</label>
                                                <input type="text" class="form-control" id="car-number" placeholder="car-number">
                                            </div>
                                            <div class="form-group">
                                                <label for="description">চালান নোট</label>
                                                <textarea name="description" type="text" class="form-control" id="description"></textarea>
                                            </div>
                                            <button id="make-as-on-going-submit-btn" type="button" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.example large modal -->
        @endif
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function(){
            // Get current page and set current in nav
            $('input[type="checkbox"]').change(function() {
                $('.counter_display').html($("[name='invoice']:checked").length)
            });

            $('.select-all').click(function(event) {
                $('.counter_display').html($("[name='invoice']:checked").length)
            });

            $('.un-select-all').click(function(event) {
                $('.counter_display').html($("[name='invoice']:checked").length)
            });

            $(".edit-inv").click( function (){
                var html_embed_code = `<embed type="text/html" src="`+$(this).val()+`" width="100%" height="600">`;
                $('#extra-large-modal-body').html(html_embed_code);
                $('#extra-large-modal-body').addClass( "text-center" );
                $('#extra-large-modal-title').text( "ভাউচার" );
                $('#extra-large-modal').modal('show');
            });

            $(".show-inv").click( function (){
                var html_embed_code = `<embed type="text/html" src="`+$(this).val()+`" width="750" height="500">`;
                $('#extra-large-modal-body').html(html_embed_code);
                $('#extra-large-modal-body').addClass( "text-center" );
                $('#extra-large-modal-title').text( "ভাউচার" );
                $('#extra-large-modal').modal('show');
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
                        if($('.invoice-table input:checkbox[name=invoice]:checked').length < 1){
                            alert('দয়া করে কিছু সংখ্যক ভাউচার পছন্দ করুন');
                        }else{
                            var invoices = []
                            $('.invoice-table input:checkbox[name=invoice]:checked').each(function()
                            {
                                invoices.push($(this).val())
                            });

                            var this_btn = $(this);
                            var formData = new FormData();
                            formData.append('invoices', invoices);
                            $.ajax({
                                method: 'POST',
                                url: '{{ route('manager.invoice.makeAsDeleted') }}',
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
                                            title: 'ডিলিট',
                                            text: data.message,
                                        });
                                        location.reload();
                                    }else{
                                        Swal.fire({
                                            icon: data.type,
                                            title: 'দুঃখিত...',
                                            text: data.message,
                                            footer: 'কোথাও কিছু একটা সমস্যা হয়েছে!'
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
    @if (Request::is('*/manager/invoice/status/received') || Request::is('*/manager/invoice/status/received/branch/*'))
    <script>
        $(document).ready(function(){
            $(".make-as-on-going-btn").click( function (){
                $('#inv-modal-title').text( "মালামাল ট্রাকে উঠানোর জন্য ড্রাইভার এর তথ্য লিপিবদ্ধ করুন" );
                $('#inv-modal').modal('show');
            });

            $("#make-as-on-going-submit-btn").click( function (){
                if($('.invoice-table input:checkbox[name=invoice]:checked').length < 1){
                    alert('দয়া করে কিছু সংখ্যক ভাউচার পছন্দ করুন');
                }else{
                    var invoices = []
                    $('.invoice-table input:checkbox[name=invoice]:checked').each(function()
                    {
                        invoices.push($(this).val())
                    });

                    var this_btn = $(this);
                    var formData = new FormData();
                    formData.append('invoices', invoices);
                    formData.append('branch_office', $('#branch-office').val());
                    formData.append('driver_name', $('#driver-name').val());
                    formData.append('driver_phone', $('#driver-phone').val());
                    formData.append('car_number', $('#car-number').val());
                    formData.append('chalan_note', $('#description').val());
                    $.ajax({
                        method: 'POST',
                        url: '{{ route('manager.chalan.store') }}',
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
                                $('#inv-modal').modal('hide');
                                $('.invoice-table input:checkbox[name=invoice]:checked')
                                    .parentsUntil('td')
                                    .html( "<h3><b>On Going ...</b></h3>" );
                                var html_embed_code = `<embed type="text/html" src="`+data.url+`" width="750" height="800">`;
                                $('#extra-large-modal-body').html(html_embed_code);
                                $('#extra-large-modal-body').addClass( "text-center" );
                                $('#extra-large-modal-title').text( "এন্ট্রি চালান" );
                                $('#extra-large-modal').modal('show');
                                Swal.fire({
                                    icon: data.type,
                                    title: 'এন্ট্রি চালান',
                                    text: data.message,
                                });
                            }else{
                                Swal.fire({
                                    icon: data.type,
                                    title: 'দুঃখিত...',
                                    text: data.message,
                                    footer: 'কোথাও কিছু একটা সমস্যা হয়েছে!'
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
            });
        });
    </script>
    @endif
    @if (Request::is('*/manager/invoice/status/on-going') || Request::is('*/manager/invoice/status/on-going/branch/*'))
    <script>
        $(document).ready(function(){
            $(".make-as-delivered-btn").click( function (){
                Swal.fire({
                    title: 'আপনি কি নিশ্চিত?',
                    text: "সত্যই ট্রাকের মালগুলো ডেলিভারি হয়ে গেছে!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#2ba809',
                    cancelButtonColor: '#003cef',
                    confirmButtonText: 'হ্যাঁ ডেলিভারি সম্পন্ন!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        if($('.invoice-table input:checkbox[name=invoice]:checked').length < 1){
                            alert('দয়া করে কিছু সংখ্যক ভাউচার পছন্দ করুন');
                        }else{
                            var invoices = []
                            $('.invoice-table input:checkbox[name=invoice]:checked').each(function()
                            {
                                invoices.push($(this).val())
                            });

                            var this_btn = $(this);
                            var formData = new FormData();
                            formData.append('invoices', invoices);
                            $.ajax({
                                method: 'POST',
                                url: '{{ route('manager.invoice.makeAsDelivered') }}',
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
                                            title: 'ডেলিভারি সম্পন্ন',
                                            text: data.message,
                                        });
                                        location.reload();
                                    }else{
                                        Swal.fire({
                                            icon: data.type,
                                            title: 'দুঃখিত...',
                                            text: data.message,
                                            footer: 'কোথাও কিছু একটা সমস্যা হয়েছে!'
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
    @endif
    @if (Request::is('*/manager/condition-invoice'))
        <script>
            $(document).ready(function(){
                $(".make-as-break-btn").click( function (){
                    Swal.fire({
                        title: 'আপনি কি নিশ্চিত?',
                        text: "কন্ডিশন ভাঙলে মেসেজ যাবে !",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#2ba809',
                        cancelButtonColor: '#003cef',
                        confirmButtonText: 'হ্যাঁ ডকন্ডিশন ভাঙ্গন!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            if($('.invoice-table input:checkbox[name=invoice]:checked').length < 1){
                                alert('দয়া করে কিছু সংখ্যক ভাউচার পছন্দ করুন');
                            }else{
                                var invoices = []
                                $('.invoice-table input:checkbox[name=invoice]:checked').each(function()
                                {
                                    invoices.push($(this).val())
                                });

                                var this_btn = $(this);
                                var formData = new FormData();
                                formData.append('invoices', invoices);
                                $.ajax({
                                    method: 'POST',
                                    url: '{{ route('manager.invoice.makeAsBreak') }}',
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
                                                title: 'কন্ডিশন ভাঙ্গন সম্পন্ন',
                                                text: data.message,
                                            });
                                            location.reload();
                                        }else{
                                            Swal.fire({
                                                icon: data.type,
                                                title: 'দুঃখিত...',
                                                text: data.message,
                                                footer: 'কোথাও কিছু একটা সমস্যা হয়েছে!'
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
    @endif
@endpush
@push('summer-note')
    <script>
        $('#description').summernote({
            placeholder: 'Hello stand alone ui',
            tabsize: 2,
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link']],
                ['view', ['fullscreen',]]
            ]
        });
    </script>
@endpush
