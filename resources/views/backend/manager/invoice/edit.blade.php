
    <style>
        .ui-autocomplete {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1000;
            display: none;
            float: left;
            min-width: 160px;
            padding: 5px 0;
            margin: 2px 0 0;
            list-style: none;
            font-size: 14px;
            text-align: left;
            background-color: #ffffff;
            border: 1px solid #cccccc;
            border: 1px solid rgba(0, 0, 0, 0.15);
            border-radius: 4px;
            -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
            background-clip: padding-box;
            height: 500px;
            overflow: auto;
        }

        .ui-autocomplete > li > div {
            display: block;
            padding: 3px 20px;
            clear: both;
            font-weight: normal;
            line-height: 1.42857143;
            color: #333333;
            white-space: nowrap;
        }

        .ui-state-hover,
        .ui-state-active,
        .ui-state-focus {
            text-decoration: none;
            color: #262626;
            background-color: #f5f5f5;
            cursor: pointer;
        }

        .ui-helper-hidden-accessible {
            border: 0;
            clip: rect(0 0 0 0);
            height: 1px;
            margin: -1px;
            overflow: hidden;
            padding: 0;
            position: absolute;
            width: 1px;
        }
    </style>
    <link href="{{ asset('assets/backend/dist/css/style.min.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="row">
        <div class="col-sm-12">
            <div class="card card-body">
                <form class="form-horizontal mt-4" id="invoice-form">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="sender-name">প্রেরকের নাম</label>
                            <input type="hidden" value="sender-name">
                            <input type="text" class="form-control search-item" id="sender-name" name="sender-name" placeholder="Sender name" value="{{ $invoice->sender_name }}">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="receiver-name">প্রাপকের নাম</label>
                            <input type="hidden" value="receiver-name">
                            <input type="text" class="form-control search-item" id="receiver-name" name="receiver-name" placeholder="Receiver name" value="{{ $invoice->receiver->name ?? '' }}">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="receiver-phone">প্রাপকের ফোন</label>
                            <input type="hidden" value="receiver-phone">
                            <input type="text" class="form-control search-item" id="receiver-phone" name="receiver-phone" placeholder="Receiver phone" value="{{ $invoice->receiver->phone ?? '' }}">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="receiver-email">প্রাপকের ইমেইল</label>
                            <input type="hidden" value="receiver-email">
                            <input type="email" class="form-control search-item" id="receiver-email" name="receiver-email" placeholder="Receiver Email" value="{{ $invoice->receiver->email ?? '' }}">
                        </div>
                    </div>
                    <div class="form-group button-group">
                        @foreach($linked_branches as $linked_branch)
                            <div class="btn-group">
                                <label class="btn btn-outline btn-info button-group">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="branch-{{ $linked_branch->toBranch->id }}" name="branch" @if($invoice->to_branch_id == $linked_branch->toBranch->id) checked @endif value="{{ $linked_branch->toBranch->id }}" class="custom-control-input branch">
                                        <label class="custom-control-label" for="branch-{{ $linked_branch->toBranch->id }}"> <i class="ti-check text-active" aria-hidden="true"></i> {{ $linked_branch->toBranch->name }} </label>
                                    </div>
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="5" id="description" name="description" placeholder="Description">{!! $invoice->description !!}</textarea>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="input-quantity">সংখ্যা</span>
                                </div>
                                <input type="text" class="form-control" onClick="this.select();" min="0" id="quantity" v-model="quantity" value="{{ $invoice->quantity }}">
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="input-price">মূল্য</span>
                                </div>
                                <input type="text" class="form-control" onClick="this.select();" min="0" id="price" v-model="price" value="{{ $invoice->price }}">
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="input-advance">পরিশোধিত </span>
                                </div>
                                <input type="text" class="form-control" onClick="this.select();" min="0" id="advance" v-model="advance" value="{{ $invoice->paid }}">
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="input-home">হোম ডেলিভারি</span>
                                </div>
                                <input type="text" class="form-control" onClick="this.select();" min="0" id="home" v-model="home" value="{{ $invoice->home }}">
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="input-labour">লেবার খরচ</span>
                                </div>
                                <input type="text" class="form-control" onClick="this.select();" min="0" id="labour" v-model="labour" value="{{ $invoice->labour }}">
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="input-due">বাকি টাকা</span>
                                </div>
                                <input type="text" class="form-control bg-danger" id="due" v-bind:value="due" disabled readonly value="{{ $invoice->price + $invoice->home + $invoice->labour - $invoice->paid }}">
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="input-total" >মোট টাকা</span>
                                </div>
                                <input type="text" class="form-control bg-success" min="0" id="total" v-bind:value="total" disabled readonly value="{{ $invoice->price + $invoice->home + $invoice->labour }}">
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">স্বাক্ষর</span>
                                </div>
                                <input type="text" class="form-control bg-secondary" value="{{ $invoice->creator->name ?? '' }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button type="button" id="save-invoice" class="btn waves-effect waves-light btn-lg btn-primary"> ভাউচার আপডেট </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <script type="text/javascript">
        let invoice = new Vue({
            el: "#invoice-form",
            data: {
                quantity: 0,
                price: 0,
                advance: 0,
                home: 0,
                labour: 0,
                due: 0,
                total: 0,
            },
            watch: {
                quantity(){
                    if (parseFloat(this.quantity) < 0 || this.quantity.length < 1){
                        this.quantity = 0;
                    }
                },
                advance(){
                    if (parseFloat(this.advance) < 0 || this.advance.length < 1){
                        this.advance = 0;
                    }
                    this.total_due_calculate();
                },
                price(){
                    if (parseFloat(this.price) < 0 || this.price.length < 1){
                        this.price = 0;
                    }
                    this.total_calculate();
                    this.total_due_calculate();
                },
                home(){
                    if (parseFloat(this.home) < 0 || this.home.length < 1){
                        this.home = 0;
                    }
                    this.total_calculate();
                    this.total_due_calculate();
                },
                labour(){
                    if (parseFloat(this.labour) < 0 || this.labour.length < 1){
                        this.labour = 0;
                    }
                    this.total_calculate();
                    this.total_due_calculate();
                }
            },
            methods: {
                total_calculate(){
                    this.total = parseFloat(this.price) + parseFloat(this.home) + parseFloat(this.labour);
                },
                total_due_calculate(){
                    this.due = parseFloat(this.total) - parseFloat(this.advance);
                }
            }
        });
    </script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(document).ready(function(){

            $( "#sender-name" ).autocomplete({
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
                                    label: obj.sender_name  //Show as label of input field
                                }
                            })
                            response($.ui.autocomplete.filter(array, request.term));
                        },
                    })
                },
                minLength: 1,
            });

            $( "#receiver-name" ).autocomplete({
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
                    $('#receiver-email').val(ui.item.email);
                    $('.branch').attr('checked', false);
                    $('#branch-'+ui.item.sender_branch).attr('checked', true);
                }
            });

            $( "#receiver-phone" ).autocomplete({
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

            $( "#receiver-email" ).autocomplete({
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

            $('#save-invoice').click( function (){
                var this_btn = $(this);
                $.ajax({
                    method: 'PATCH',
                    url: '{{ route('manager.invoice.update', $invoice) }}',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data:{
                        sender_name:$('#sender-name').val(),
                        receiver_name:$('#receiver-name').val(),
                        receiver_phone:$('#receiver-phone').val(),
                        receiver_email:$('#receiver-email').val(),
                        branch:$('input:radio[name=branch]:checked').val(),
                        description:$('#description').val(),
                        quantity:$('#quantity').val(),
                        price:$('#price').val(),
                        advance:$('#advance').val(),
                        home:$('#home').val(),
                        labour:$('#labour').val(),
                    },
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
                            $('#invoice-form').trigger("reset");
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

