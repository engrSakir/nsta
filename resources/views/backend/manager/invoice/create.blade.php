@push('title')
    ভাউচার তৈরি
@endpush
@extends('layouts.backend.app')
@push('style')

@endpush
@section('breadcrumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">ভাউচার তৈরি</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('manager.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">ভাউচার</li>
                </ol>
                <a href="{{ route('manager.invoice.index') }}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i>ভাউচার লিস্ট</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-body">
                <form class="form-horizontal mt-4" id="create-inv-form">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="sender-name">প্রেরকের নাম</label>
                            <input type="hidden" value="sender-name">
                            <input type="text" class="form-control search-item" id="sender-name" name="sender-name" placeholder="Sender name" value="">
                        </div>
                        @if(Request::is('*/manager/condition-invoice/create'))
                            <div class="form-group col-md-3">
                                <label for="sender-phone">প্রেরকের ফোন</label>
                                <input type="hidden" value="sender-phone">
                                <input type="text" class="form-control search-item" id="sender-phone" name="sender-phone" placeholder="Sender phone" value="">
                            </div>
                        @endif
                        <div class="form-group col-md-3">
                            <label for="receiver-name">প্রাপকের নাম</label>
                            <input type="hidden" value="receiver-name">
                            <input type="text" class="form-control search-item" id="receiver-name" name="receiver-name" placeholder="Receiver name" value="">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="receiver-phone">প্রাপকের ফোন</label>
                            <input type="hidden" value="receiver-phone">
                            <input type="text" class="form-control search-item" id="receiver-phone" name="receiver-phone" placeholder="Receiver phone" value="">
                        </div>
                        <div class="form-group col-md-3" style="display:none;">
                            <label for="receiver-email">প্রাপকের ইমেইল</label>
                            <input type="hidden" value="receiver-email">
                            <input type="email" class="form-control search-item" id="receiver-email" name="receiver-email" placeholder="Receiver Email" value="">
                        </div>
                    </div>
                    <div class="form-group button-group">
                        @foreach($linked_branches as $linked_branch)
                        <div class="btn-group">
                            <label class="btn btn-outline btn-info button-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="branch-{{ $linked_branch->toBranch->id }}" name="branch" value="{{ $linked_branch->toBranch->id }}" class="custom-control-input branch">
                                    <label class="custom-control-label" for="branch-{{ $linked_branch->toBranch->id }}"> <i class="ti-check text-active" aria-hidden="true"></i> {{ $linked_branch->toBranch->name }} </label>
                                </div>
                            </label>
                        </div>
                        @endforeach
                    </div>
                    @if(Request::is('*/manager/condition-invoice/create'))
                        <div class="form-group">
                            <label class="form-control-label" for="condition-amount">কন্ডিশন টাকার পরিমান</label>
                            <input type="text" class="form-control is-valid" id="condition-amount" name="condition-amount">
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="condition-charge">কন্ডিশন চার্জ</label>
                            <input type="text" class="form-control is-valid" id="condition-charge" name="condition-charge">
                        </div>
                    @endif
                    <div class="form-group">
                        <textarea class="form-control is-valid" rows="5" id="description" name="description" placeholder="Description"></textarea>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="input-quantity">সংখ্যা</span>
                                </div>
                                <input type="text" class="form-control" onClick="this.select();" min="0" id="quantity" value="0">
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="input-price">মূল্য</span>
                                </div>
                                <input type="text" class="form-control" onClick="this.select();" min="0" id="price" value="0">
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="input-advance">পরিশোধিত </span>
                                </div>
                                <input type="text" class="form-control" onClick="this.select();" min="0" id="advance" value="0">
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="input-home">হোম ডেলিভারি</span>
                                </div>
                                <input type="text" class="form-control" onClick="this.select();" min="0" id="home" value="0">
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="input-labour">লেবার খরচ</span>
                                </div>
                                <input type="text" class="form-control" onClick="this.select();" min="0" id="labour" value="0">
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="input-due">বাকি টাকা</span>
                                </div>
                                <input type="text" class="form-control bg-danger" id="due" disabled readonly value="0">
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="input-total" >মোট টাকা</span>
                                </div>
                                <input type="text" class="form-control bg-success" min="0" id="total" disabled readonly value="0">
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">স্বাক্ষর</span>
                                </div>
                                <input type="text" class="form-control bg-secondary" value="{{ auth()->user()->name }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button type="button" id="save-invoice" class="btn waves-effect waves-light btn-lg btn-primary"> ভাউচার সেভ </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function(){
            //Auto calculation
            var price= 0;
            $("#create-inv-form #price" ).autocomplete({
                source: function(request, response) {
                    price = parseFloat(request.term);
                    $('#create-inv-form #total').val(price + home + labour);
                    $('#create-inv-form #due').val(price - advance + home + labour);
                },
            });

            var advance = 0;
            $("#create-inv-form #advance" ).autocomplete({
                source: function(request, response) {
                    advance  = parseFloat(request.term);
                    $('#create-inv-form #due').val(price - advance + home + labour);
                },
            });

            var home= 0;
            $("#create-inv-form #home" ).autocomplete({
                source: function(request, response) {
                    home = parseFloat(request.term);
                    $('#create-inv-form #total').val(price + home + labour);
                    $('#create-inv-form #due').val(price - advance + home + labour);
                },
            });

            var labour= 0;
            $("#create-inv-form #labour" ).autocomplete({
                source: function(request, response) {
                    labour = parseFloat(request.term);
                    $('#create-inv-form #total').val(price + home + labour);
                    $('#create-inv-form #due').val(price - advance + home + labour);
                },
            });

            //Auto Search
            $( "#create-inv-form #sender-name" ).autocomplete({
                source: function(request, response) {
                    // console.log(request.term);
                    var formData = new FormData();
                    formData.append('name', request.term)
                    $.ajax({
                        method: 'POST',
                        url: "{{ route('manager.senderName') }}",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: formData,
                        processData: false,
                        contentType: false,
                        success:function(data){
                            // console.log(data)
                            var array = $.map(data,function(obj){
                                return{
                                    value: obj.sender_name, //Fillable in input field
                                    label: obj.sender_name + ' '+obj.sender_phone,  //Show as label of input field
                                    phone: obj.sender_phone,
                                }
                            })
                            response($.ui.autocomplete.filter(array, request.term));
                        },
                    })
                },
                minLength: 1,
                select:function(event, ui){
                    //console.log(ui.item);
                    $('#sender-phone').val(ui.item.phone);
                }
            });

            @if(Request::is('*/manager/condition-invoice/create'))
            $( "#create-inv-form #sender-phone" ).autocomplete({
                source: function(request, response) {
                    // console.log(request.term);
                    var formData = new FormData();
                    formData.append('phone', request.term)
                    $.ajax({
                        method: 'POST',
                        url: "{{ route('manager.senderPhone') }}",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: formData,
                        processData: false,
                        contentType: false,
                        success:function(data){
                            // console.log(data)
                            var array = $.map(data,function(obj){
                                return{
                                    value: obj.sender_phone, //Fillable in input field
                                    label: obj.sender_phone + ' '+obj.sender_name,  //Show as label of input field
                                    phone: obj.sender_name,
                                }
                            })
                            response($.ui.autocomplete.filter(array, request.term));
                        },
                    })
                },
                minLength: 1,
                select:function(event, ui){
                    //console.log(ui.item);
                    $('#sender-name').val(ui.item.phone);
                }
            });
            @endif


            $( "#create-inv-form #receiver-name" ).autocomplete({
                source: function(request, response) {
                    // console.log(request.term);
                    var formData = new FormData();
                    formData.append('name', request.term)
                    formData.append('search_type','name')
                    $.ajax({
                        method: 'POST',
                        url: "{{ route('manager.receiverInfo') }}",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: formData,
                        processData: false,
                        contentType: false,
                        success:function(data){
                            // console.log(data)
                            var array = $.map(data,function(obj){
                                return{
                                    value: obj.name, //Filable in input field
                                    label: obj.name + '<br>' + obj.phone + '<br>' + obj.email,  //Show as label of input field
                                    phone: obj.phone,
                                    email: obj.email,
                                    sender_branch: obj.to_branch_id,
                                }
                            })
                            response($.ui.autocomplete.filter(array, request.term));
                        },
                    })
                },
                minLength: 1,
                select:function(event, ui){
                    //console.log(ui.item);
                    $('#receiver-phone').val(ui.item.phone);
                    $('#receiver-email').val(ui.item.email);
                    $('.branch').attr('checked', false);
                    $('#branch-'+ui.item.sender_branch).attr('checked', true);
                }
            });

            $( "#create-inv-form #receiver-phone" ).autocomplete({
                source: function(request, response) {
                    // console.log(request.term);
                    var formData = new FormData();
                     formData.append('search_type','phone')
                    formData.append('phone', request.term)
                    $.ajax({
                        method: 'POST',
                        url: "{{ route('manager.receiverInfo') }}",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: formData,
                        processData: false,
                        contentType: false,
                        success:function(data){
                            // console.log(data)
                            var array = $.map(data,function(obj){
                                return{
                                    value: obj.phone, //Filable in input field
                                    label: obj.name + '-' + obj.phone + '-' + obj.email,  //Show as label of input field
                                    name: obj.name,
                                    email: obj.email,
                                    sender_branch: obj.to_branch_id
                                }
                            })
                            response($.ui.autocomplete.filter(array, request.term));
                        },
                    })
                },
                minLength: 1,
                select:function(event, ui){
                    //console.log(ui.item);
                    $('#receiver-name').val(ui.item.name);
                    $('#receiver-email').val(ui.item.email);
                    $('.branch').attr('checked', false);
                    $('#branch-'+ui.item.sender_branch).attr('checked', true);
                }
            });

            $( "#create-inv-form #receiver-email" ).autocomplete({
                source: function(request, response) {
                    // console.log(request.term);
                    var formData = new FormData();
                    formData.append('email', request.term)
                     formData.append('search_type','email')
                    $.ajax({
                        method: 'POST',
                        url: "{{ route('manager.receiverInfo') }}",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: formData,
                        processData: false,
                        contentType: false,
                        success:function(data){
                            // console.log(data)
                            var array = $.map(data,function(obj){
                                return{
                                    value: obj.email, //Filable in input field
                                    label: obj.name + '-' + obj.phone + '-' + obj.email,  //Show as label of input field
                                    phone: obj.phone,
                                    name: obj.name,
                                    sender_branch: obj.to_branch_id
                                }
                            })
                            response($.ui.autocomplete.filter(array, request.term));
                        },
                    })
                },
                minLength: 1,
                select:function(event, ui){
                    //console.log(ui.item);
                    $('#receiver-phone').val(ui.item.phone);
                    $('#receiver-name').val(ui.item.name);
                    $('.branch').attr('checked', false);
                    $('#branch-'+ui.item.sender_branch).attr('checked', true);
                }
            });
            @if(Request::is('*/manager/condition-invoice/create'))
            $( "#create-inv-form #receiver-email" ).autocomplete({
                source: function(request, response) {
                    // console.log(request.term);
                    var formData = new FormData();
                    formData.append('email', request.term)
                    formData.append('search_type','email')
                    $.ajax({
                        method: 'POST',
                        url: "{{ route('manager.receiverInfo') }}",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: formData,
                        processData: false,
                        contentType: false,
                        success:function(data){
                            // console.log(data)
                            var array = $.map(data,function(obj){
                                return{
                                    value: obj.email, //Filable in input field
                                    label: obj.name + '-' + obj.phone + '-' + obj.email,  //Show as label of input field
                                    phone: obj.phone,
                                    name: obj.name,
                                    sender_branch: obj.to_branch_id
                                }
                            })
                            response($.ui.autocomplete.filter(array, request.term));
                        },
                    })
                },
                minLength: 1,
                select:function(event, ui){
                    //console.log(ui.item);
                    $('#receiver-phone').val(ui.item.phone);
                    $('#receiver-name').val(ui.item.name);
                    $('.branch').attr('checked', false);
                    $('#branch-'+ui.item.sender_branch).attr('checked', true);
                }
            });
            @endif


            $('#create-inv-form #save-invoice').click( function (){
                var formData = new FormData();
                var this_btn = $(this);
                formData.append('sender_name', $('#sender-name').val());
                formData.append('receiver_name', $('#receiver-name').val());
                formData.append('receiver_phone', $('#receiver-phone').val());
                formData.append('receiver_email', $('#receiver-email').val());
                formData.append('branch', $('input:radio[name=branch]:checked').val());
                formData.append('description', $('#description').val());
                formData.append('quantity', $('#quantity').val());
                formData.append('price', $('#price').val());
                formData.append('advance', $('#advance').val());
                formData.append('home', $('#home').val());
                formData.append('labour', $('#labour').val());
                @if(Request::is('*/manager/condition-invoice/create'))
                formData.append('condition', true);
                formData.append('condition_amount', $('#condition-amount').val());
                formData.append('condition_charge', $('#condition-charge').val());
                formData.append('sender_phone', $('#sender-phone').val());
                @endif
                $.ajax({
                    method: 'POST',
                    url: '{{ route('manager.invoice.store') }}',
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
                            $('#create-inv-form').trigger("reset");
                            var html_embed_code = `<embed type="text/html" src="`+data.url+`" width="750" height="500">`;
                            $('#extra-large-modal-body').html(html_embed_code);
                            $('#extra-large-modal-body').addClass( "text-center" );
                            $('#extra-large-modal-title').text( "INVOICE" );
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
            });
        });
    </script>
@endpush
