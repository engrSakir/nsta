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
            margin-top: 0.5cm; /* <any of the usual CSS values for margins> */
            margin-left: 1cm; /* <any of the usual CSS values for margins> */
            margin-right: 1cm; /* <any of the usual CSS values for margins> */
            margin-bottom: 0.5cm; /* <any of the usual CSS values for margins> */
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

        .inv-paid-seal {
            /* The image used */
            background-image: url("{{ asset('uploads/images/setting/paid.png') }}");
            background-position: center;
            background-repeat: no-repeat;
        }

        .inv-due-seal {
            /* The image used */
            background-image: url("{{ asset('uploads/images/setting/due.png') }}");
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
                            <td  style="text-align: center; font-size: 22px;" class="right-color bottom-color @if(($invoice->price + $invoice->home + $invoice->labour) > $invoice->paid)  inv-due-seal @else inv-paid-seal @endif">
                                {{ en_to_bn($invoice->price)  }}

                            </td>
                        </tr>
                    </table>
                    <table class="background" style="width: 100%;">
                        <tbody>
                        <tr>
                            <td style="width:25%">
                                <table style="width: 100%;">
                                    <tr>
                                        <td  style="text-align: center; width: 50%;">কুড়িগ্রাম</td>
                                        <td  style="text-align: center; width: 50%;">01407055770</td>
                                    </tr>
                                </table>
                            </td>
                            <td style="width:25%">
                                <table style="width: 100%;">
                                    <tr>
                                        <td  style="text-align: center; width: 50%;">গাইবান্ধা </td>
                                        <td  style="text-align: center; width: 50%;">01407055775</td>
                                    </tr>
                                </table>
                            </td>
                            <td style="text-align: right; width:27%">হোম ডেলিভারি- </td>
                            <td style="text-align: center; width:22%; border: 1px solid black;"><b>{{ en_to_bn($invoice->home) }}</b></td>
                        </tr>
                        <tr>
                            <td style="">
                                <table style="width: 100%;">
                                    <tr>
                                        <td  style="text-align: center; width: 50%;">রংপুর</td>
                                        <td  style="text-align: center; width: 50%;">01407055772</td>
                                    </tr>
                                </table>
                            </td>
                            <td style="">
                                <table style="width: 100%;">
                                    <tr>
                                        <td  style="text-align: center; width: 50%;">শঠিবাড়ী</td>
                                        <td  style="text-align: center; width: 50%;">01407055776</td>
                                    </tr>
                                </table>
                            </td>
                            <td style="text-align: right;">লেবার - </td>
                            <td style="text-align: center; border: 1px solid black;"><b>{{ en_to_bn($invoice->labour) }}</b></td>
                        </tr>
                        <tr>
                            <td style="">
                                <table style="width: 100%;">
                                    <tr>
                                        <td  style="text-align: center; width: 50%;">নাগেশ্বরী</td>
                                        <td  style="text-align: center; width: 50%;">01407055773</td>
                                    </tr>
                                </table>
                                </td>
                            <td style="">
                                <table style="width: 100%;">
                                    <tr>
                                        <td  style="text-align: center; width: 50%;">কিশোরগঞ্জ</td>
                                        <td  style="text-align: center; width: 50%;">01407055786</td>
                                    </tr>
                                </table>
                            </td>
                            <td style="text-align: right; ">মোট - </td>
                            <td style="text-align: center; border: 1px solid black;"><b>{{ en_to_bn($invoice->price + $invoice->home + $invoice->labour) }}</b></td>
                        </tr>
                        <tr>
                            <td style="">
                                <table style="width: 100%;">
                                    <tr>
                                        <td  style="text-align: center; width: 50%;">সৈয়দপুর</td>
                                        <td  style="text-align: center; width: 50%;">01407055774</td>
                                    </tr>
                                </table>
                            </td>
                            <td style="">

                            </td>
                            <td style="text-align: right; ">অগ্রীম - </td>
                            <td style="text-align: center; border: 1px solid black;"><b>{{ en_to_bn($invoice->paid) }}</b></td>
                        </tr>
                        <tr>
                            <td style="text-align: left;"> </td>
                            <td style="text-align: left;"></td>
                            <td style="text-align: right; ">বাকী - </td>
                            <td style="text-align: center; border: 1px solid black;"><b>{{ en_to_bn($invoice->price + $invoice->home + $invoice->labour - $invoice->paid) }}</b></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End col -->
    <div class="col-lg-12">
        <table style="width: 100%;">
            <tr style="width: 100%;">
                <td style="width: 30%; text-align: left;">
                    প্রেরকের স্বাক্ষর-
                </td>
                <td style="width: 40%; text-align: center;">
                    <b>কন্ডিশনে মাল বুকিং করা হয়। </b>
                </td>
                <td style="width: 30%; text-align: right;">
                    কর্মকর্তার স্বাক্ষর-{{ $invoice->creator->name }}
                </td>
            </tr>
        </table>

    </div>
    <!-- Start row -->
    <!-- End row -->
</div>
</body>
</html>
