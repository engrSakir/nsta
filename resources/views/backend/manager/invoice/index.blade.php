@push('title')
    Dashboard
@endpush
@extends('layouts.backend.app')
@push('style')

@endpush
@section('breadcrumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor font-weight-bold">Status: {{ $status ?? '' }}/Branch: {{ $branch_name ?? '' }}</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('manager.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Invoice</li>
                </ol>
                <a href="{{ route('manager.invoice.create') }}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create Invoice</a>
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
                        <h4 class="font-light text-white font-weight-bold"> {{ \App\Models\Branch::find($branch_id)->name }}</h4>
                        <h6 class="text-white"> Invoice: {{ $invoice_items->count() }} </h6>
                        <h6 class="text-white">
                            Price : {{ $invoice_items->sum('price') + $invoice_items->sum('home') + $invoice_items->sum('labour') }}
                            <br>
                            Due : {{ $invoice_items->sum('price') + $invoice_items->sum('home') + $invoice_items->sum('labour') - $invoice_items->sum('paid') }}
                            <br>
                            Paid : {{ $invoice_items->sum('paid') }}
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
                    <h4 class="card-title">Invoice List</h4>
{{--                    <h6 class="card-subtitle">Add class <code>.color-bordered-table .primary-bordered-table</code></h6>--}}
                    <div class="row button-group">
                        <div class="col-lg-2 col-md-4">
                            <button type="button" class="btn waves-effect waves-light btn-block btn-info select-all">Select all</button>
                        </div>
                        <div class="col-lg-2 col-md-4">
                            <button type="button" class="btn waves-effect waves-light btn-block btn-success un-select-all">Un select all</button>
                        </div>
                        <div class="col-lg-2 col-md-4">
                            <button type="button" class="btn waves-effect waves-light btn-block btn-danger delete-selected-all">Delete selected</button>
                        </div>
                        @if (Request::is('*/manager/invoice/status/received') || Request::is('*/manager/invoice/status/received/branch/*'))
                        <div class="col-lg-2 col-md-4">
                            <button type="button" class="btn waves-effect waves-light btn-block btn-info make-as-on-going-btn">Make as On Going</button>
                        </div>
                        @endif
                        @if (Request::is('*/manager/invoice/status/on-going') || Request::is('*/manager/invoice/status/on-going/branch/*'))
                        <div class="col-lg-2 col-md-4">
                            <button type="button" class="btn waves-effect waves-light btn-block btn-info make-as-delivered-btn">Make as Delivered</button>
                        </div>
                        @endif
                    </div>
                    <div class="invoice-table table-responsive">
                        <table class="table color-bordered-table primary-bordered-table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer</th>
                                <th>Office</th>
                                <th>Payment</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($invoices as $invoice)
                            <tr>
                                <td>
                                    <label class="btn btn-info active">
                                        <div class="custom-control custom-checkbox mr-sm-2">
                                            <input type="checkbox" value="{{ $invoice->id }}" name="invoice" class="custom-control-input" id="invoice-{{ $loop->iteration }}">
                                            <label class="custom-control-label font-weight-bold" for="invoice-{{ $loop->iteration }}">#{{ $invoice->custom_counter }}</label>
                                        </div>
                                    </label>

                                </td>
                                <td>
                                    <b style="font-size: 18px;">{{ $invoice->receiver->name ?? '' }}</b><br>
                                    {{ $invoice->receiver->phone ?? '' }}<br>
                                    {{ $invoice->receiver->email ?? '' }}<br>
                                    <span class="badge badge-success">
                                        {{ $invoice->sender_name ?? '' }}
                                    </span>
                                </td>
                                <td style="font-size: 16px;">
                                    {{ $invoice->toBranch->name ?? '' }}<br>
                                    <b>{{ $invoice->created_at->format('d/m/Y') }}</b>
                                </td>
                                <td style="font-size: 16px;">
                                    <span class="text-danger">Due: {{ $invoice->price + $invoice->home + $invoice->labour - $invoice->paid }}</span><br>
                                    <span class="text-info">Paid: {{ $invoice->paid }}</span><br>
                                    <span class="text-success">Total: {{ $invoice->price + $invoice->home + $invoice->labour }}</span>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-info btn-circle btn-lg show-inv" value="{{ route('manager.invoice.show', $invoice) }}"><i class="mdi mdi-cloud-print"></i> </button>
                                    <button type="button" class="btn btn-warning btn-circle btn-lg"><i class="mdi mdi-tooltip-edit"></i> </button>
                                    <button type="button" class="btn btn-danger btn-circle btn-lg" onclick="delete_function(this)" value="{{ route('manager.invoice.destroy', $invoice) }}"><i class="mdi mdi-delete-circle"></i> </button>
                                </td>
                            </tr>
                            @endforeach
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer</th>
                                <th>Office</th>
                                <th>Payment</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            </tbody>
                        </table>
                    </div>
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
                                        <h4 class="card-title">Hello {{ auth()->user()->name }} !!</h4>
                                        <h6 class="card-subtitle"> Make a chalan sheet </h6>
                                        <div class="mt-4">
                                            <div class="form-group">
                                                <label for="branch-office">Branch office</label>
                                                <select class="form-control custom-select" id="branch-office">
                                                    <option selected value="">--Select your branch office--</option>
                                                    @foreach($invoices->groupBy('to_branch_id') as $branch_id => $invoice_items)
                                                        <option value="{{ $branch_id }}">{{ \App\Models\Branch::find($branch_id)->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="driver-name">Driver-name</label>
                                                <input type="text" class="form-control" id="driver-name" placeholder="Driver name">
                                            </div>
                                            <div class="form-group">
                                                <label for="driver-phone">Driver-phone</label>
                                                <input type="text" class="form-control" id="driver-phone" placeholder="Driver phone">
                                            </div>
                                            <div class="form-group">
                                                <label for="car-number">Car-number</label>
                                                <input type="text" class="form-control" id="car-number" placeholder="car-number">
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
            $(".show-inv").click( function (){
                var html_embed_code = `<embed type="text/html" src="`+$(this).val()+`" width="750" height="500">`;
                $('#extra-large-modal-body').html(html_embed_code);
                $('#extra-large-modal-body').addClass( "text-center" );
                $('#extra-large-modal-title').text( "INVOICE" );
                $('#extra-large-modal').modal('show');
            });

            $(".delete-selected-all").click( function (){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#74051e',
                    cancelButtonColor: '#aad9e2',
                    confirmButtonText: 'Yes, delete!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        if($('.invoice-table input:checkbox[name=invoice]:checked').length < 1){
                            alert('Please chose invoice');
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
                                            title: 'DELETED',
                                            text: data.message,
                                        });
                                        location.reload();
                                    }else{
                                        Swal.fire({
                                            icon: data.type,
                                            title: 'Oops...',
                                            text: data.message,
                                            footer: 'Something went wrong!'
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
                                        title: 'Oops...',
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
                $('#inv-modal-title').text( "Make as on going" );
                $('#inv-modal').modal('show');
            });

            $("#make-as-on-going-submit-btn").click( function (){
                if($('.invoice-table input:checkbox[name=invoice]:checked').length < 1){
                    alert('Please chose invoice');
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
                                var html_embed_code = `<embed type="text/html" src="`+data.url+`" width="750" height="800">`;
                                $('#extra-large-modal-body').html(html_embed_code);
                                $('#extra-large-modal-body').addClass( "text-center" );
                                $('#extra-large-modal-title').text( "Chalan" );
                                $('#extra-large-modal').modal('show');
                                Swal.fire({
                                    icon: data.type,
                                    title: 'INVOICE',
                                    text: data.message,
                                });
                            }else{
                                Swal.fire({
                                    icon: data.type,
                                    title: 'Oops...',
                                    text: data.message,
                                    footer: 'Something went wrong!'
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
                                title: 'Oops...',
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
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#2ba809',
                    cancelButtonColor: '#003cef',
                    confirmButtonText: 'Yes, delivered it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        if($('.invoice-table input:checkbox[name=invoice]:checked').length < 1){
                            alert('Please chose invoice');
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
                                            title: 'DELIVERED',
                                            text: data.message,
                                        });
                                        location.reload();
                                    }else{
                                        Swal.fire({
                                            icon: data.type,
                                            title: 'Oops...',
                                            text: data.message,
                                            footer: 'Something went wrong!'
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
                                        title: 'Oops...',
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
