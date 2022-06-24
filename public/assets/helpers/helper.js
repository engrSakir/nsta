
$(document).ready(function () {
    // Get current page and set current in nav
    $("nav>ul").find("li").each(function () {
        var navItem = $(this);
        if (navItem.find("a").attr("href") == location.protocol + '//' + location.host + location.pathname) {
            //This li active
            //navItem.css( "background-color", "lightgreen" );
            //Auto 1 active of Parent/Children
            if (navItem.parent().parent().children('.has-arrow').length) {
                navItem.parent().parent().children('ul').addClass("in");
                navItem.parent().parent().children('a').attr("aria-expanded", "true");
                navItem.parent().parent().children('a').addClass("active");
            }
            //Auto 2 active of Parent/Children/Children
            if (navItem.parent().parent().parent().parent().children('.has-arrow').length) {
                navItem.parent().parent().parent().parent().children('ul').addClass("in");
                navItem.parent().parent().parent().parent().children('a').attr("aria-expanded", "true");
                navItem.parent().parent().parent().parent().children('a').addClass("active");
            }
            //Auto 3 active of Parent/Children/Children/Children
            if (navItem.parent().parent().parent().parent().parent().parent().children('.has-arrow').length) {
                navItem.parent().parent().parent().parent().parent().parent().children('ul').addClass("in");
                navItem.parent().parent().parent().parent().parent().parent().children('a').attr("aria-expanded", "true");
                navItem.parent().parent().parent().parent().parent().parent().children('a').addClass("active");
            }
            //Auto 4 active of Parent/Children/Children/Children/Children
            if (navItem.parent().parent().parent().parent().parent().parent().parent().parent().children('.has-arrow').length) {
                navItem.parent().parent().parent().parent().parent().parent().parent().parent().children('ul').addClass("in");
                navItem.parent().parent().parent().parent().parent().parent().parent().parent().children('a').attr("aria-expanded", "true");
                navItem.parent().parent().parent().parent().parent().parent().parent().parent().children('a').addClass("active");
            }
            //Auto 5 active of Parent/Children/Children/Children/Children/Children
            if (navItem.parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().children('.has-arrow').length) {
                navItem.parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().children('ul').addClass("in");
                navItem.parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().children('a').attr("aria-expanded", "true");
                navItem.parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().children('a').addClass("active");
            }
        }
    });

    $(".logout-btn").click(function () {
        Swal.fire({
            title: 'আপনি কি নিশ্চিত?',
            text: "ফোন নাম্বার অথবা ইউজারনেম মনে রাখলে পুনরায় লগইন করতে পারবেন!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#061a6c',
            cancelButtonColor: '#b8c7c1',
            confirmButtonText: 'হ্যাঁ লগআউট!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    method: 'POST',
                    url: "/logout",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function (response) {
                        if (response.type == 'success') {
                            Swal.fire(
                                'ধন্যবাদ !',
                                response.message,
                                response.type
                            )
                            location.replace(response.url);
                        } else {
                            Swal.fire(
                                'দুঃখিত !',
                                response.message,
                                response.type
                            )
                        }
                    },
                    error: function (xhr) {
                        var errorMessage = '<div class="card bg-danger">\n' +
                            '                        <div class="card-body text-center p-5">\n' +
                            '                            <span class="text-white">';
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            errorMessage += ('' + value + '<br>');
                        });
                        errorMessage += '</span>\n' +
                            '                        </div>\n' +
                            '                    </div>';
                        Swal.fire({
                            icon: 'error',
                            title: 'দুঃখিত...',
                            footer: errorMessage
                        })
                    },
                })
            }
        })
    });

    // select all check box
    $('.select-all').click(function (event) {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        for (var checkbox of checkboxes) {
            checkbox.checked = true;
        }
    });

    // un select all check box
    $('.un-select-all').click(function (event) {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        for (var checkbox of checkboxes) {
            checkbox.checked = false;
        }
    });


    //Chose image
    $(".image-chose-btn").click(function () {
        $(this).parent().find('.image-importer').click();
    })

    //Display image
    $(".image-importer").change(function (event) {
        if (event.target.files.length > 0) {
            $(this).parent().find('.image-display').attr("src", URL.createObjectURL(event.target.files[0]));
        }
    })

    //Reset image
    $(".image-reset-btn").click(function () {
        $(this).parent().find('.image-display').attr("src", $(this).val());
        $(this).parent().find('.image-importer').val('');
    })

    //Submit image
    $(".image-submit-btn").click(function () {
        var url = $(this).val();
        var formData = new FormData();
        var this_btn = $(this);
        formData.append('image', $(this).parent().find('.image-importer')[0].files[0]);
        $.ajax({
            method: 'POST',
            url: url,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                this_btn.prop("disabled", true);
            },
            complete: function () {
                this_btn.prop("disabled", false);
            },
            success: function (data) {
                if (data.type == 'success') {
                    Swal.fire({
                        position: 'top-end',
                        icon: data.type,
                        title: data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    this_btn.parent().find(".image-reset-btn").val(data.image_url);
                } else {
                    Swal.fire({
                        icon: data.type,
                        title: 'দুঃখিত...',
                        text: data.message,
                        footer: 'Something went wrong!'
                    });
                }
            },
            error: function (xhr) {
                var errorMessage = '<div class="card bg-danger">\n' +
                    '                        <div class="card-body text-center p-5">\n' +
                    '                            <span class="text-white">';
                $.each(xhr.responseJSON.errors, function (key, value) {
                    errorMessage += ('' + value + '<br>');
                });
                errorMessage += '</span>\n' +
                    '                        </div>\n' +
                    '                    </div>';
                Swal.fire({
                    icon: 'error',
                    title: 'দুঃখিত...',
                    footer: errorMessage
                });
            },
        })
    })

    //contact-form-submit
    $(".send-message-button").click(function () {
        var this_btn = $(this);
        var button_text = $(this).text();
        var formData = new FormData();
        formData.append('name', $('#contact-form').find('#name').val())
        formData.append('email', $('#contact-form').find('#email').val())
        formData.append('phone', $('#contact-form').find('#phone').val())
        formData.append('subject', $('#contact-form').find('#subject').val())
        formData.append('message', $('#contact-form').find('#message').val())
        $.ajax({
            method: 'POST',
            url: "/contact-message-store",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                this_btn.prop("disabled", true);
                this_btn.text("Please wait ...");
            },
            complete: function () {
                this_btn.prop("disabled", false);
                this_btn.text(button_text);
            },
            success: function (data) {
                if (data.type == 'success') {
                    Swal.fire({
                        position: 'top-end',
                        icon: data.type,
                        title: data.message,
                        timer: 1500
                    });
                    setTimeout(function () {
                        $('#contact-form').trigger("reset");
                    }, 800);
                } else {
                    Swal.fire({
                        icon: data.type,
                        title: 'দুঃখিত...',
                        text: data.message,
                        footer: 'Something went wrong!'
                    });
                }
            },
            error: function (xhr) {
                var errorMessage = '<div class="card bg-danger">\n' +
                    '                        <div class="card-body text-center p-5">\n' +
                    '                            <span class="text-white">';
                $.each(xhr.responseJSON.errors, function (key, value) {
                    errorMessage += ('' + value + '<br>');
                });
                errorMessage += '</span>\n' +
                    '                        </div>\n' +
                    '                    </div>';
                Swal.fire({
                    icon: 'error',
                    title: 'দুঃখিত...',
                    footer: errorMessage
                });
            },
        });
    })

    // subscribe now
    $('.subscribe-now-btn').click(function () {
        var this_btn = $(this);
        var button_text = $(this).val();
        $.ajax({
            method: 'POST',
            url: "/subscribe/store",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: { email: $('#subscribe-email').val() },
            dataType: 'JSON',
            beforeSend: function () {
                this_btn.prop("disabled", true);
                this_btn.val("Please wait ...");
            },
            complete: function () {
                this_btn.prop("disabled", false);
                this_btn.val(button_text);
            },
            success: function (response) {
                if (response.type == 'success') {
                    $('#subscribe-email').val("");
                    Swal.fire(
                        'ধন্যবাদ !',
                        response.message,
                        'success'
                    )
                } else {
                    Swal.fire(
                        'দুঃখিত !',
                        response.message,
                        response.type
                    )
                }
            },
            error: function (xhr) {
                var errorMessage = '<div class="card bg-danger">\n' +
                    '                        <div class="card-body text-center p-5">\n' +
                    '                            <span class="text-white">';
                $.each(xhr.responseJSON.errors, function (key, value) {
                    errorMessage += ('' + value + '<br>');
                });
                errorMessage += '</span>\n' +
                    '                        </div>\n' +
                    '                    </div>';
                Swal.fire({
                    icon: 'error',
                    title: 'দুঃখিত...',
                    footer: errorMessage
                })
            },
        })
    });

    // invoice dearch now
    $('.invoice-search-field').autocomplete({
        source: function (request, response) {
            console.log(request.term);
            var formData = new FormData();
            formData.append('custom_counter', request.term)
            formData.append('search_type', 'custom_counter')
            $.ajax({
                method: 'POST',
                url: "/backend/manager/ui-autocomplete/receiver-info",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    console.log(data)
                    var array = $.map(data, function (obj) {
                        return {
                            value: obj.custom_counter + '/' + obj.date, //Filable in input field
                            label: obj.custom_counter + '/' + obj.date + ' - ' + obj.status,  //Show as label of input field
                            id: obj.id,
                        }
                    })
                    response($.ui.autocomplete.filter(array, request.term));
                },
            })
        },
        minLength: 1,
        select: function (event, ui) {
            //console.log(ui.item);
            $('#searched-invoice').val(ui.item.id);
        }
    });

    $('.show-invoice-use-btn').click(function () {
        var this_btn = $(this);
        if (!this_btn.val()) {
            alert('Please select invoice')
        } else {
            var html_embed_code = `<embed type="text/html" src="` + location.protocol + '//' + location.host + "/backend/manager/invoice/" + this_btn.val() + `" width="750" height="500">`;
            $('#extra-large-modal-body').html(html_embed_code);
            $('#extra-large-modal-body').addClass("text-center");
            $('#extra-large-modal-title').text("ভাউচার");
            $('#extra-large-modal-edit-btn').val(this_btn.val());
            $('#extra-large-modal').modal('show');
        }
    });

    $(".edit-inv").click(function () {
        invoice_id = $(this).val();
        // alert(invoice_id)
        $('#extra-large-modal').modal('hide');
        $.ajax({
            method: 'GET',
            url: "/backend/manager/invoice/" + invoice_id + "/edit",
            success: function (data) {
                console.log(data)

                $('#edit-inv-form #edit-save-invoice').val(data.invoice_id);
                $('#edit-inv-form #edit-sender-name').val(data.invoice_name);
                $('#edit-inv-form #edit-sender-phone').val(data.invoice_phone);
                $('#edit-inv-form #edit-receiver-name').val(data.receiver_name);
                $('#edit-inv-form #edit-receiver-phone').val(data.receiver_phone);
                $('#edit-branch-' + data.to_branch_id).prop("checked", true);
                $('#edit-inv-form #edit-condition-amount').val(data.condition_amount);
                $('#edit-inv-form #edit-condition-charge').val(data.condition_charge);
                $('#edit-inv-form #edit-description').val(data.description);
                $('#edit-inv-form #edit-input-quantity').val(data.quantity);
                $('#edit-inv-form #edit-input-price').val(data.price);
                $('#edit-inv-form #edit-input-home').val(data.home);
                $('#edit-inv-form #edit-input-labour').val(data.labour);
                $('#edit-inv-form #edit-input-advance').val(data.paid);
                $('#edit-inv-form #edit-input-total').val(data.price + data.home + data.labour);
                if (data.condition_amount > 10) {
                    $(".edit-condition-area").css("display", "block");
                } else {
                    $(".edit-condition-area").css("display", "none");
                }
            },
        })
        $('#edit-extra-large-modal-body').addClass("text-center");
        $('#edit-extra-large-modal-title').text("ভাউচার");
        $('#edit-extra-large-modal').modal('show');
    });

});

function delete_function(objButton) {
    var url = objButton.value;
    // alert(objButton.value)
    Swal.fire({
        title: 'আপনি কি নিশ্চিত?',
        text: "একবার ডিলিট করে ফেললে এটিকে আর ফিরিয়ে আনতে পারবেন না!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#74051e',
        cancelButtonColor: '#aad9e2',
        confirmButtonText: 'হ্যাঁ ডিলিট হোক'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: 'DELETE',
                url: url,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (data) {
                    if (data.type == 'success') {
                        Swal.fire(
                            'ডিলিট !',
                            'সঠিকভাবে ডিলিট সম্পন্ন হয়েছে।  ' + data.message,
                            'success'
                        )
                        if (data.url) {
                            setTimeout(function () {
                                location.replace(data.url);
                            }, 800);//
                        } else {
                            setTimeout(function () {
                                location.reload();
                            }, 800);//
                        }
                    } else {
                        Swal.fire(
                            'দুঃখিত',
                            'কোথাও কিছু একটা সমস্যা হয়েছে. ' + data.message,
                            'warning'
                        )
                    }
                },
            })
        }
    })
}

function bind_linked_branches() {
    $.ajax({
        method: 'GET',
        url: "/backend/manager/get_linked_branches",
        success: function (branches) {
            // console.log(branches)
            branches_html = '';
            $.each(branches, function (index, value) {
                // console.log(value);
                branches_html +=
                    `<div class="btn-group">
                        <label class="btn btn-outline btn-info button-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="edit-branch-`+ value.id + `" name="branch" value="` + value.id + `" class="custom-control-input branch">
                                <label class="custom-control-label" for="edit-branch-`+ value.id + `"> <i class="ti-check text-active" aria-hidden="true"></i>
                                `+ value.name + `
                                </label>
                            </div>
                        </label>
                    </div>`;
            });
            $('.linked_branches').html(branches_html);
        },
    })
}
bind_linked_branches();




