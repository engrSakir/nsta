<!-- example large modal -->
<div class="modal bs-example-modal-lg" id="extra-large-modal" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="extra-large-modal-title">
                    {{-- Assign by ajax --}}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="extra-large-modal-body">
                {{-- Assign by ajax --}}
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-warning waves-effect text-left text-white edit-inv"
                    id="extra-large-modal-edit-btn">Edit</button>
                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.example large modal -->

<!-- edit example large modal -->
<div class="modal bs-example-modal-lg" id="edit-extra-large-modal" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="edit-extra-large-modal-title">
                    {{-- Assign by ajax --}}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="edit-extra-large-modal-body">
                {{-- Value Assign by ajax --}}
                <form class="form-horizontal mt-4" id="edit-inv-form">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="sender-name">প্রেরকের নাম</label>
                            <input type="hidden" value="sender-name">
                            <input type="text" class="form-control search-item" id="edit-sender-name" name="sender-name"
                                placeholder="Sender name" value="">
                        </div>
                        {{-- This id condition type invoice --}}
                        <div class="form-group col-md-3 edit-condition-area">
                            <label for="sender-phone">প্রেরকের ফোন</label>
                            <input type="hidden" value="sender-phone">
                            <input type="text" class="form-control search-item" id="edit-sender-phone"
                                name="sender-phone" placeholder="Sender phone" value="">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="receiver-name">প্রাপকের নাম</label>
                            <input type="hidden" value="receiver-name">
                            <input type="text" class="form-control search-item" id="edit-receiver-name"
                                name="receiver-name" placeholder="Receiver name" value="">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="receiver-phone">প্রাপকের ফোন</label>
                            <input type="hidden" value="receiver-phone">
                            <input type="text" class="form-control search-item" id="edit-receiver-phone"
                                name="receiver-phone" placeholder="Receiver phone" value="">
                        </div>
                        <div class="form-group col-md-3" style="display:none;">
                            <label for="receiver-email">প্রাপকের ইমেইল</label>
                            <input type="hidden" value="receiver-email">
                            <input type="email" class="form-control search-item" id="edit-receiver-email"
                                name="receiver-email" placeholder="Receiver Email" value="">
                        </div>
                    </div>
                    <div class="form-group button-group">
                        <div class="linked_branches">
                            {{-- Assign by ajaz --}}
                        </div>
                    </div>

                    {{-- This id condition type invoice --}}
                    <div class="form-group edit-condition-area">
                        <label class="form-control-label" for="condition-amount">কন্ডিশন টাকার পরিমান</label>
                        <input type="text" class="form-control is-valid" id="edit-condition-amount"
                            name="condition-amount" value="">
                    </div>
                    <div class="form-group edit-condition-area">
                        <label class="form-control-label" for="condition-charge">কন্ডিশন চার্জ</label>
                        <input type="text" class="form-control is-valid" id="edit-condition-charge"
                            name="condition-charge" value="">
                    </div>

                    <div class="form-group">
                        <textarea class="form-control" rows="5" id="edit-description" name="description"
                            placeholder="Description"></textarea>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" for="edit-input-quantity">সংখ্যা</span>
                                </div>
                                <input type="text" class="form-control" onClick="this.select();" min="0"
                                    id="edit-input-quantity" value="">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" for="edit-input-price">মূল্য</span>
                                </div>
                                <input type="text" class="form-control price" onClick="this.select();" min="0"
                                    id="edit-input-price" value="">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" for="edit-input-home">হোম ডেলিভারি</span>
                                </div>
                                <input type="text" class="form-control home" onClick="this.select();" min="0"
                                    id="edit-input-home" value="">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" for="edit-input-labour">লেবার খরচ</span>
                                </div>
                                <input type="text" class="form-control labour" onClick="this.select();" min="0"
                                    id="edit-input-labour" value="">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" for="edit-input-advance">অগ্রীম </span>
                                </div>
                                <input type="text" class="form-control advance" onClick="this.select();" min="0"
                                    id="edit-input-advance" value="">
                            </div>
                        </div>
                        <div class="form-group col-md-6" style="display:none">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" for="edit-input-due">বাকি টাকা</span>
                                </div>
                                <input type="text" class="form-control bg-danger due" id="edit-input-due" disabled
                                    readonly value="">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" for="edit-input-total">মোট টাকা</span>
                                </div>
                                <input type="text" class="form-control bg-success total" min="0" id="edit-input-total"
                                    disabled readonly value="">
                            </div>
                        </div>
                        <div class="form-group col-md-6" style="display:none">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">স্বাক্ষর</span>
                                </div>
                                <input type="text" class="form-control bg-secondary" value="" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button type="button" id="edit-save-invoice"
                            class="btn waves-effect waves-light btn-lg btn-primary">
                            ভাউচার আপডেট </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.example large modal -->

<script>
    $(document).ready(function() {
        $('.edit-condition-area').css("display", "none");

        $('#edit-input-price').on('keyup change', function() {
            edit_inv_calculate();
        });
        $('#edit-input-home').on('keyup change', function() {
            edit_inv_calculate();
        });
        $('#edit-input-labour').on('keyup change', function() {
            edit_inv_calculate();
        });
        // $('#edit-input-advance').on('keyup change', function() {
        //     edit_inv_calculate();
        // });

        //Auto Search
        $("#edit-inv-form #edit-sender-name").autocomplete({
            source: function(request, response) {
                console.log(request.term);
                var formData = new FormData();
                formData.append('name', request.term)
                $.ajax({
                    method: 'POST',
                    url: "{{ route('manager.senderName') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        // console.log(data)
                        var array = $.map(data, function(obj) {
                            if (obj.sender_phone) {
                                s_phone = ' #' + obj.sender_phone;
                            } else {
                                s_phone = " ";
                            }
                            return {
                                value: obj
                                    .sender_name, //Fillable in input field
                                label: obj.sender_name +
                                    s_phone, //Show as label of input field
                                phone: obj.sender_phone,
                            }
                        })
                        response($.ui.autocomplete.filter(array, request.term));
                    },
                })
            },
            minLength: 1,
            select: function(event, ui) {
                //console.log(ui.item);
                $('#edit-sender-phone').val(ui.item.phone);
            }
        });
        $("#edit-inv-form #edit-sender-phone").autocomplete({
            source: function(request, response) {
                console.log(request.term);
                var formData = new FormData();
                formData.append('phone', request.term)
                $.ajax({
                    method: 'POST',
                    url: "{{ route('manager.senderPhone') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        console.log(data)
                        var array = $.map(data, function(obj) {
                            return {
                                value: obj
                                    .sender_phone, //Fillable in input field
                                label: obj.sender_phone + ' ' + obj
                                    .sender_name, //Show as label of input field
                                phone: obj.sender_name,
                            }
                        })
                        response($.ui.autocomplete.filter(array, request.term));
                    },
                })
            },
            minLength: 1,
            select: function(event, ui) {
                //console.log(ui.item);
                $('#edit-sender-name').val(ui.item.phone);
            }
        });
        $("#edit-inv-form #edit-receiver-name").autocomplete({
            source: function(request, response) {
                // console.log(request.term);
                var formData = new FormData();
                formData.append('name', request.term)
                formData.append('search_type', 'name')
                $.ajax({
                    method: 'POST',
                    url: "{{ route('manager.receiverInfo') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        // console.log(data)
                        var array = $.map(data, function(obj) {
                            if (obj.phone) {
                                r_phone = ' #' + obj.phone;
                            } else {
                                r_phone = " ";
                            }

                            if (obj.email) {
                                r_email = ' #' + obj.email;
                            } else {
                                r_email = " ";
                            }

                            return {
                                value: obj.name, //Filable in input field
                                label: obj.name + r_phone +
                                    r_email, //Show as label of input field
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
            select: function(event, ui) {
                //console.log(ui.item);
                $('#edit-receiver-phone').val(ui.item.phone);
                $('#edit-receiver-email').val(ui.item.email);
                $('#edit-branch-' + ui.item.sender_branch).prop('checked', true);
            }
        });
        $("#edit-inv-form #edit-receiver-phone").autocomplete({
            source: function(request, response) {
                // console.log(request.term);
                var formData = new FormData();
                formData.append('search_type', 'phone')
                formData.append('phone', request.term)
                $.ajax({
                    method: 'POST',
                    url: "{{ route('manager.receiverInfo') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        // console.log(data)
                        var array = $.map(data, function(obj) {
                            return {
                                value: obj.phone, //Filable in input field
                                label: obj.name + '-' + obj.phone + '-' + obj
                                    .email, //Show as label of input field
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
            select: function(event, ui) {
                //console.log(ui.item);
                $('#edit-receiver-name').val(ui.item.name);
                $('#edit-receiver-email').val(ui.item.email);
                // $('.branch').attr('checked', false);
                $('#edit-branch-' + ui.item.sender_branch).attr('checked', true);
            }
        });
        $("#edit-inv-form #edit-receiver-email").autocomplete({
            source: function(request, response) {
                // console.log(request.term);
                var formData = new FormData();
                formData.append('email', request.term)
                formData.append('search_type', 'email')
                $.ajax({
                    method: 'POST',
                    url: "{{ route('manager.receiverInfo') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        // console.log(data)
                        var array = $.map(data, function(obj) {
                            return {
                                value: obj.email, //Filable in input field
                                label: obj.name + '-' + obj.phone + '-' + obj
                                    .email, //Show as label of input field
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
            select: function(event, ui) {
                //console.log(ui.item);
                $('#edit-receiver-phone').val(ui.item.phone);
                $('#edit-receiver-name').val(ui.item.name);
                // $('.branch').attr('checked', false);
                $('#edit-branch-' + ui.item.sender_branch).attr('checked', true);
            }
        });

        //Update submit
        $('#edit-inv-form #edit-save-invoice').click(function() {
            var this_btn = $(this);
            if ($('#edit-condition-amount').val() > 0) {
                condition = true;
            }else{
                condition = false;
            }
            $.ajax({
                method: 'PATCH',
                // type: 'PATCH',
                url: '/backend/manager/invoice/' + this_btn.val(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'sender_name':  $('#edit-sender-name').val(),
                    'receiver_name':  $('#edit-receiver-name').val(),
                    'receiver_phone':  $('#edit-receiver-phone').val(),
                    'receiver_email':  $('#edit-receiver-email').val(),
                    'branch':  $('input:radio[name=branch]:checked').val(),
                    'description':  $('#edit-description').val(),
                    'quantity':  $('#edit-input-quantity').val(),
                    'price':  $('#edit-input-price').val(),
                    'advance':  $('#edit-input-advance').val(),
                    'home':  $('#edit-input-home').val(),
                    'labour':  $('#edit-input-labour').val(),
                    'condition_amount': $('#edit-condition-amount').val(),
                    'condition_charge': $('#edit-condition-charge').val(),
                    'sender_phone': $('#edit-sender-phone').val(),
                    'condition': condition
                },
                // processData: false,
                // contentType: false,
                beforeSend: function() {
                    //this_btn.html('Please wait ---- ');
                    this_btn.prop("disabled", true);
                },
                complete: function() {
                    //this_btn.html('Edit now');
                    this_btn.prop("disabled", false);
                },
                success: function(data) {
                    console.log(data);
                    if (data.type == 'success') {
                        var office_wise_payment_info = '';
                        $.each(data.offices, function(office_index, office) {
                            office_wise_payment_info +=
                                `<div class="col-lg-2 col-md-4"> <button type="button" class="btn btn-block disabled  btn-outline-info">` +
                                office[0] + '(' + office[1] + ')' +
                                `</button></div>`;
                        });
                        $('#office_wise_payment_info').html(office_wise_payment_info);

                        $('#create-inv-form').trigger("reset");
                        var html_embed_code = `<embed type="text/html" src="` + data.url +
                            `" width="750" height="500">`;
                        $('#extra-large-modal-body').html(html_embed_code);
                        $('#extra-large-modal-body').addClass("text-center");
                        $('#extra-large-modal-title').text("INVOICE");
                        $('#extra-large-modal-edit-btn').val(data.invoice_id);
                        $('#edit-extra-large-modal').modal('hide');
                        $('#extra-large-modal').modal('show');
                        $.getJSON('/backend/manager/get-last-five-invoice', function(data) {
                            //console.log(data)
                            var lastFiveInvoice = '';
                            data.forEach(function(invoice) {
                                lastFiveInvoice +=
                                    `<a type="button" target="_blank" class="btn btn-secondary text-danger" href="` +
                                    location.protocol + '//' + location
                                    .host + "/backend/manager/invoice/" +
                                    invoice.id + `">` + invoice
                                    .custom_counter + `</a>`;
                            })
                            $("#last-five-invoice").html(lastFiveInvoice)
                        })
                        Swal.fire({
                            position: 'top-end',
                            icon: data.type,
                            title: 'INVOICE',
                            showConfirmButton: false,
                            text: data.message,
                            timer: 1500
                        })
                    } else {
                        Swal.fire({
                            icon: data.type,
                            title: 'Oops...',
                            text: data.message,
                            footer: 'Something went wrong!'
                        });
                    }
                },
                error: function(xhr) {
                    var errorMessage = '<div class="card bg-danger">\n' +
                        '                        <div class="card-body text-center p-5">\n' +
                        '                            <span class="text-white">';
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        errorMessage += ('' + value + '<br>');
                    });
                    errorMessage += '</span>\n' +
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

    function edit_inv_calculate() {
        $('#edit-input-total').val();
        price = $("#edit-inv-form  #edit-input-price").val() ?? 0;
        home = $("#edit-inv-form  #edit-input-home").val() ?? 0;
        labour = $("#edit-inv-form  #edit-input-labour").val() ?? 0;
        // advance = $("#edit-inv-form  #edit-input-advance").val() ?? 0;
        advance = $("#edit-inv-form  #edit-input-total").val(parseInt(price) + parseInt(home) + parseInt(labour));
    }
</script>
