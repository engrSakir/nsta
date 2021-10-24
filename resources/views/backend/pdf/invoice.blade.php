<!DOCTYPE html>
<html lang="en">
<head>
    <title> ভাউচারঃ {{ $invoice->custom_counter ?? '---' }}  </title>
    <style>
        @page  {
            background-color: #ffffff;
        }
        @page {
            sheet-size: A5-L;
            background-color: azure;
            vertical-align: top;
            margin-top: 0.3cm; /* <any of the usual CSS values for margins> */
            margin-bottom: 0.3cm; /* <any of the usual CSS values for margins> */
            margin-left: 1cm; /* <any of the usual CSS values for margins> */
            margin-right: 1cm; /* <any of the usual CSS values for margins> */

            margin-header: 0; /* <any of the usual CSS values for margins> */
            margin-footer: 0; /* <any of the usual CSS values for margins> */
            marks: none;/*crop | cross | none*/

            /*https://mpdf.github.io/css-stylesheets/supported-css.html*/
            /*https://mpdf.github.io/paging/different-page-sizes.html*/
        }

        .inv-description {
            /* The image used */
            @if(($invoice->price + $invoice->home + $invoice->labour) > $invoice->paid)
                background-image: url("{{ asset($invoice->fromBranch->invoice_due_watermark ?? get_static_option('no_image')) }}");
            @else
                background-image: url("{{ asset($invoice->fromBranch->invoice_paid_watermark ?? get_static_option('no_image')) }}");
            @endif
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            height: 5.0cm;
        }

        .inv-right-seal {
            /* The image used */
            @if(($invoice->price + $invoice->home + $invoice->labour) > $invoice->paid)
                background-image: url("{{ asset('uploads/images/setting/due.png') }}");
            @else
                background-image: url("{{ asset('uploads/images/setting/paid.png') }}");
            @endif

            background-position: center;
            background-repeat: no-repeat;
        }

        body{
            font-family: bengali_englisg, sans-serif;
        }
        .left-color{
            border-left: 1px solid black;

        }

        .right-color{
            border-right: 1px solid black;
        }

        .top-color{
            border-top: 1px solid black;
        }
        .bottom-color{
            border-bottom: 1px solid black;
        }
        .left-right-bottom-color{
            border-left: 1px solid black;
            border-right: 1px solid black;
            border-bottom: 1px solid black;
            padding: 0px 10px;
        }
    </style>
</head>
<body class="vertical-layout">
<!-- Start Containerbar  -->
<div class="row">
    {{-- Company --}}
    <div class="col-12" style="margin-top: -5px; margin-bottom: -5px;">
        <table class="table table-bordered table-striped" style="width: 100%;">
            <tr>
                <th style="width: 20%;">
                    <img src="{{ asset($invoice->fromBranch->company->logo ?? get_static_option('no_image')) }}" width="20%" height="50px" class="img-fluid" alt="">
                </th>
                <th class="" style="font-size: 280%; width: 80%; margin-left: -20px;">
                    {{ $invoice->fromBranch->company->name ?? '---' }}
                </th>
            </tr>
        </table>
    </div>
    {{-- Company line 1 & 2 --}}
    <div class="col-12">
        <table class="table table-bordered table-striped" style="width: 100%;">
            <tr><!--serial+text+logo+office-->
                <td class="text-center" style=" width: 100%; ">
                    <table class="" style="width: 100%; height: 100%; ">
                        <tr>
                            <td class="" style="width: 20%; text-align: left">
                                <b class=""> নং: </b><b class="">{{ $invoice->custom_counter }}</b>
                            </td>
                            <td class="" style="text-align: center; font-size: 80%;">
                                <b>{!! $invoice->fromBranch->invoice_heading_one ?? '' !!}</b>
                                <p>{!! $invoice->fromBranch->invoice_heading_two ?? ''  !!}</p>
                            </td>
                        </tr>
                    </table>
                </td>
            <!-- Barcode  up th will be style="width: 80%;"
                <th style="width: 20%;">
                    <img src="{{ 'uploads/images/company/logo/logo.png' }}" width="18%" height="18.5%" class="img-fluid" alt="" >
                </th>
                -->
            </tr>
        </table>
    </div>
    {{-- Customer --}}
    <div class="col-12">
        <table class="table table-bordered table-striped" style="width: 100%; margin: -5px; ">
            <tr>
                <td style="width: 30%; text-align: left" >
                    প্রেরকঃ <b>{{ $invoice->sender_name ?? '---' }}</b>
                </td>
                <td class="" style="width: 30%; text-align: center">
                    <!--Date-->
                    বুকিং তারিখ- {{ $invoice->created_at->format('d/m/Y') }}
                </td>
                <td class="" style="width: 30%; text-align: right">
                    প্রাপকঃ <b> {{ $invoice->receiver->name ?? '---' }}</b> <br> মোবাইলঃ<b> {{ $invoice->receiver->phone ?? '---' }}</b>
                </td>
            </tr>
        </table>
        <table class="table table-bordered table-striped" style="width: 100%; margin: -5px; ">
            <tr>
                <td style="width: 30%; text-align: left" >
                    ঠিকানাঃ {{ $invoice->fromBranch->name ?? '---' }}
                </td>
                <td class="" style="width: 30%; text-align: center">
                    <!--Time-->
                    বুকিং সময়- {{ $invoice->created_at->format('h:i A') }}
                </td>
                <td class="" style="width: 30%; text-align: right">
                    ঠিকানাঃ {{ $invoice->toBranch->name ?? '---' }}
                </td>
            </tr>
        </table>
    </div>
</div>
<div class="row">
    <!-- Start col -->
    <div class="col-lg-12">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="table-responsive">
                    {{-- Table body --}}
                    <table class="table table-bordered table-striped" style="width: 100%;">
                        <!-- align="center" valign="top" -->
                        <tr style="width: 100%;"  >
                            <td class="" style="width: 10%; background-color: rgba(11,198,145,0.5); padding-top: 2px; text-align: center;">
                                সংখ্যা
                            </td>
                            <td class="text-center" style="width: 70%;  background-color: rgba(11,198,145,0.5); padding-top: 2px; text-align: center;">
                                মালের বিবরণ
                            </td>
                            <td class="text-center " style="width: 20%;  background-color: rgba(11,198,145,0.5); padding-top: 2px; text-align: center;">
                                মোট
                            </td>
                        </tr>
                        <tr>
                            <th  style="text-align: center" class="left-color bottom-color">
                                {{ $invoice->quantity }}
                            </th>
                            <td class="left-right-bottom-color inv-description">
                                <pre style="text-align: left; font-family: bengali_englisg;"> @if($invoice->condition_amount > 0) <b>কন্ডিশনঃ {{ en_to_bn($invoice->condition_amount) }} + চার্জঃ {{ en_to_bn($invoice->condition_charge) }} = মোটঃ {{ en_to_bn($invoice->condition_amount + $invoice->condition_charge) }}</b>
                                    <hr> @endif {{ $invoice->description }}</pre>
                            </td>
                            <td  style="text-align: center; font-size: 22px;" class="right-color bottom-color inv-right-seal">
                                {{ en_to_bn($invoice->price)  }}
                            </td>
                        </tr>
                    </table>
                    {{-- Phone number table --}}
                    <div style="width: 100%;">
                        <div style="width: 20%; float: left; font-size:11px;">
                            {{ get_static_option('invoice_number_1') }} <br>
                            {{ get_static_option('invoice_number_2') }} <br>
                            {{ get_static_option('invoice_number_3') }} <br>
                            {{ get_static_option('invoice_number_4') }} <br>
                            {{ get_static_option('invoice_number_5') }}
                        </div>
                        <div style="width: 20%; float: left; font-size:11px;">
                            {{ get_static_option('invoice_number_6') }} <br>
                            {{ get_static_option('invoice_number_7') }} <br>
                            {{ get_static_option('invoice_number_8') }} <br>
                            {{ get_static_option('invoice_number_9') }} <br>
                            {{ get_static_option('invoice_number_10') }}
                        </div>
                        <div style="width: 20%; float: left; font-size:11px;">
                            {{ get_static_option('invoice_number_11') }} <br>
                            {{ get_static_option('invoice_number_12') }} <br>
                            {{ get_static_option('invoice_number_13') }} <br>
                           {{ get_static_option('invoice_number_14') }} <br>
                            {{ get_static_option('invoice_number_16') }}
                        </div>
                        <div style="width: 20%; float: left; font-size:11px;">
                            {{ get_static_option('invoice_number_16') }} <br>
                            {{ get_static_option('invoice_number_17') }} <br>
                            {{ get_static_option('invoice_number_18') }} <br>
                            {{ get_static_option('invoice_number_19') }} <br>
                            {{ get_static_option('invoice_number_20') }}
                        </div>
                        <style>
                            #table_margin td {
                              border: 1px solid black;
                            }

                            #table_margin {
                              width: 100%;
                              border-collapse: collapse;
                            }
                            </style>
                        <div style="width: 20%; float: left; font-size:12px;">
                            <table id="table_margin">
                                <tr>
                                    <td style="text-align: right">হোম ডেলিভারি</td>
                                    <td><b>{{ en_to_bn($invoice->home) }}</b></td>
                                </tr>
                                <tr>
                                    <td style="text-align: right"> লেবার</td>
                                    <td><b>{{ en_to_bn($invoice->labour) }}</b></td>
                                </tr>
                                <tr>
                                    <td style="text-align: right"> মোট</td>
                                    <td><b>{{ en_to_bn($invoice->price + $invoice->home + $invoice->labour) }}</b></td>
                                </tr>
                                <tr>
                                    <td style="text-align: right"> অগ্রীম</td>
                                    <td><b>{{ en_to_bn($invoice->paid) }}</b></td>
                                </tr>
                                <tr>
                                    <td style="text-align: right"> বাকী</td>
                                    <td><b>{{ en_to_bn($invoice->price + $invoice->home + $invoice->labour - $invoice->paid) }}</b></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End col -->
    <div style=" width:100%; height:40px;"></div>
    <div class="col-lg-12" style="background-color: rgba(255, 0, 0, 0);">
        <table style="width: 100%;">
            <tr style="width: 100%;">
                <td style="width: 10%; text-align: left;">
                    প্রেরকের স্বাক্ষর-
                </td>
                <td style="width: 40%; text-align: center;">
                    <b>কন্ডিশনে মাল বুকিং করা হয়। </b>
                </td>
                <td style="width: 40%; text-align: right;">
                    কর্মকর্তার স্বাক্ষর- {{ $invoice->creator->name }}
                </td>
            </tr>
        </table>
    </div>
    <!-- Start row -->
    <!-- End row -->
</div>
</body>
</html>
