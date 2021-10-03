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
                        <div class="form-group col-md-3">
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
                    <div class="form-group">
                        <label class="form-control-label" for="condition-amount">কন্ডিশন টাকার পরিমান</label>
                        <input type="text" class="form-control is-valid" id="edit-condition-amount"
                            name="condition-amount" value="">
                    </div>
                    <div class="form-group">
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
                                    <span class="input-group-text" id="edit-input-quantity">সংখ্যা</span>
                                </div>
                                <input type="text" class="form-control" onClick="this.select();" min="0"
                                    id="edit-quantity" value="">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="edit-input-price">মূল্য</span>
                                </div>
                                <input type="text" class="form-control price" onClick="this.select();" min="0"
                                    id="price" value="">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="edit-input-home">হোম ডেলিভারি</span>
                                </div>
                                <input type="text" class="form-control home" onClick="this.select();" min="0" id="home"
                                    value="">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="edit-input-labour">লেবার খরচ</span>
                                </div>
                                <input type="text" class="form-control labour" onClick="this.select();" min="0"
                                    id="edit-labour" value="">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="edit-input-advance">অগ্রীম </span>
                                </div>
                                <input type="text" class="form-control advance" onClick="this.select();" min="0"
                                    id="advance" value="">
                            </div>
                        </div>
                        <div class="form-group col-md-6" style="display:none">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="edit-input-due">বাকি টাকা</span>
                                </div>
                                <input type="text" class="form-control bg-danger due" id="edit-due" disabled readonly
                                    value="">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="edit-input-total">মোট টাকা</span>
                                </div>
                                <input type="text" class="form-control bg-success total" min="0" id="edit-total"
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
                <button type="button" class="btn btn-warning waves-effect text-left text-white edit-inv"
                    id="edit-extra-large-modal-edit-btn">Edit</button>
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
         price = $("#edit-inv-form .price").val() ?? 0;
         advance = $("#edit-inv-form .advance").val() ?? 0;
         home = $("#edit-inv-form .home").val() ?? 0;
         labour = $("#edit-inv-form .labour").val() ?? 0;

        $("#edit-inv-form .price").autocomplete({
            source: function(request, response) {
                price = parseFloat(request.term);
                $('#edit-inv-form #edit-total').val(price + home + labour);
                $('#edit-inv-form #edit-due').val(price - advance + home + labour);
            },
        });


        $("#edit-inv-form .advance").autocomplete({
            source: function(request, response) {
                advance = parseFloat(request.term);
                $('#edit-inv-form #edit-due').val(price - advance + home + labour);
            },
        });


        $("#edit-inv-form .home").autocomplete({
            source: function(request, response) {
                home = parseFloat(request.term);
                $('#edit-inv-form #edit-total').val(price + home + labour);
                $('#edit-inv-form #edit-due').val(price - advance + home + labour);
            },
        });


        $("#edit-inv-form .labour").autocomplete({
            source: function(request, response) {
                labour = parseFloat(request.term);
                $('#edit-inv-form #edit-total').val(price + home + labour);
                $('#edit-inv-form #edit-due').val(price - advance + home + labour);
            },
        });
    });
</script>
