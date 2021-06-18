@push('title')
    কাস্টমার লিস্ট
@endpush
@extends('layouts.backend.app')
@push('style')

@endpush
@section('breadcrumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor font-weight-bold">কাস্টমার</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('manager.dashboard') }}">ড্যাশবোর্ড</a></li>
                    <li class="breadcrumb-item active">কাস্টমার</li>
                </ol>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-heading text-center">
                    <img src="{{ asset('assets/backend/images/order-track.gif') }}" alt="" width="400px">
                </div>
                <div class="card-body">
{{--                    <h4 class="card-title">ভাউচার লিস্ট</h4>--}}
{{--                    <h6 class="card-subtitle">Add class <code>.color-bordered-table .primary-bordered-table</code></h6>--}}
                    {{ $invoices->links() }}
                    <div class="invoice-table table-responsive">
                        <table class="table color-bordered-table primary-bordered-table text-center">
                            <thead>
                            <tr>
                                <th>ভাউচার নং</th>
                                <th>প্রেরক</th>
                                <th>অফিস</th>
                                <th>
                                    <span class="badge badge-pill badge-danger">বাকি</span>
                                    <span class="badge badge-pill badge-success">পরিশোধিত</span>
                                    <span class="badge badge-pill badge-secondary">মোট</span>
                                </th>
                                <th>ভাউচার</th>
                                <th>অবস্থা</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td>{{ $invoice->custom_counter }}</td>
                                    <td>{{ $invoice->sender_name }}</td>
                                    <td>{{ $invoice->fromOffice->name ?? '#' }}</td>
                                    <td style="font-size: 16px;">
                                        <span class="badge badge-pill badge-danger">{{ en_to_bn($invoice->price + $invoice->home + $invoice->labour - $invoice->paid) }}</span>
                                        <span class="badge badge-pill badge-success">{{ en_to_bn($invoice->paid) }}</span>
                                        <span class="badge badge-pill badge-secondary">{{ en_to_bn($invoice->price + $invoice->home + $invoice->labour) }}</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-circle show-inv" value="{{ route('customer.invoice.show', $invoice) }}"><i class="mdi mdi-cloud-print"></i> </button>
                                        <a type="button" class="btn btn-info btn-circle" href="{{ route('customer.invoice.download', $invoice) }}"><i class="mdi mdi-download"></i> </a>
                                    </td>
                                    <td>
                                        @if($invoice->status == 'Received')
                                        <img src="{{ asset('assets/backend/images/delivery-one.png') }}" alt="" width="300px">
                                            @elseif($invoice->status == 'On Going')
                                            <img src="{{ asset('assets/backend/images/delivery-two.png') }}" alt="" width="300px">
                                        @else
                                            <img src="{{ asset('assets/backend/images/delivery-three.png') }}" alt="" width="300px">
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            <thead>
                            <tr>
                                <th>ভাউচার নং</th>
                                <th>প্রেরক</th>
                                <th>অফিস</th>
                                <th>
                                    <span class="badge badge-pill badge-danger">বাকি</span>
                                    <span class="badge badge-pill badge-success">পরিশোধিত</span>
                                    <span class="badge badge-pill badge-secondary">মোট</span>
                                </th>
                                <th>ভাউচার</th>
                                <th>অবস্থা</th>
                            </tr>
                            </thead>
                            </tbody>
                        </table>
                    </div>
                    {{ $invoices->links() }}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card-body" style="background-color: rgba(139,0,0,0.18)">
            <div class="table-responsive">
                ১. আপনার মাল আপনার নিজ দায়িত্বে বুক করিবেন। <br>
                ২. সরকার ঘোষিত বেআইনী মাল পণ্য পরিবহন এজেন্সী বুক করিবেন না। আগোচরে বেয়াইনী মাল বুক হইলে বা ধরা পরলে এজেন্সী দায়ী নহে, মালের পার্টি দায়ী থাকিবে।<br>
                ৩. মাল যাতায়েতের সময় কোন দৈব-দুর্ঘটনা, লুট, ডাকাতি, অগ্নিসংযোগ ও প্রাকৃতিক দুর্যোগ ইত্যাদির জন্য মালের ক্ষতি হইলে পণ্য পরিবহন এজেন্সী দায়ী নয়।<br>
                ৪. ক্রোকারীজ, কাচের মাল ও চিনামাটির মাল, তরল পদার্থ দাহ্য পদার্থ, প্লাস্টিক মাল এবং পাকিং লুজের কারণে মালের ক্ষতি বা নষ্ট হইলে পণ্য পরিবহন এজেন্সি দায়ী নয়।<br>
                ৫. গাড়ি লোড-আনলোড, ডেলিভারী করিবার সময় যদি কোন মাল বৃষ্টিতে ভিজিয়া যায় উহার জন্য এজেন্সী দায়ী নয়।<br>
                ৬. মাল পৌঁছার ৭ দিনের ভিতরে মাল ডেলিভারি নিতে হবে। ৭ দিন পর প্রতিদিনের জন্য মন প্রতি ৫/- টাকা গুদাম ভাড়া এবং তিন মাস পর মালের কোন দাবী চলিবে না। <br>
                ৭. মাল দেলিভারী লইবার পূর্বে আপনার মাল আপনি দেখিয়া লইবেন। পরে কোন আপত্তি গ্রহনযোগ্য নহে। <br>
                ৭. এজেন্সী এবং পার্টীর মধ্যকার কোন প্রকার বিরোধ দেখা দিলে এবং নিজেরা সমাধান করিতে বার্থ হইলে সংগঠনের উভয়ের স্বার্থ রক্ষায় মধ্যস্ততা করিবে।<br>
                ৭. ভারার হার পরিবর্তন ও পরিবর্ধনশীল<br>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function(){

            $(".show-inv").click( function (){
                var html_embed_code = `<embed type="text/html" src="`+$(this).val()+`" width="750" height="500">`;
                $('#extra-large-modal-body').html(html_embed_code);
                $('#extra-large-modal-body').addClass( "text-center" );
                $('#extra-large-modal-title').text( "ভাউচার" );
                $('#extra-large-modal').modal('show');
            });

        });
    </script>
@endpush
@push('summer-note')

@endpush
