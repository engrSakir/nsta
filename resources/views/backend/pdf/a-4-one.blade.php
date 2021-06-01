<!DOCTYPE html>
<html lang="en">
<head>
    <title> চালানঃ {{ $chalan->custom_counter }}  </title>
    <link href="{{ asset('assets/pdf-css/chalan.css') }}" rel="stylesheet" type="text/css">
    <style>
        @page  {
            background-color: #ffffff;
        }

        @page {
            header: page-header;
            footer: page-footer;
        }
        body {
            font-family: bengali_englisg, sans-serif;
            font-size: 10pt;
        }
    </style>
</head>
<body class="vertical-layout">

<!-- Start Containerbar  -->
<div class="row">
    <table style="width: 100%;">
        <tr>
            <td style="text-align: center">
                <label style=" border-radius: 5px; padding: 10px;"><b>এন্ট্রি চালান</b></label>
            </td>
        </tr>
    </table>
    <!-- office & company info -->
    <table style="width: 100%;">
        <tr>
            <td style="width: 30%">
                <table style="width: 100%; ">

                </table>
            </td>
            <td style="width: 60%; text-align: center;">
                <table style="width: 100%;">
                    <tr>
                        <td>
                            <img src="{{ asset($chalan->fromBranch->company->logo ?? get_static_option('no_image')) }}" width="20%" height="50px" class="img-fluid" alt="">
                            <h1><b>{{ $chalan->fromBranch->company->name ?? '' }}</b></h1>
                            <h2 style=" border-radius: 8px; ">{{ $chalan->fromBranch->chalan_heading_one ?? '' }}</h2>
                            <h6 style="font-size: 80%;">{{ $chalan->fromBranch->chalan_heading_two ?? '' }}</h6>
                            <p>{{ $chalan->fromBranch->chalan_heading_three ?? '' }} </p>

                        </td>
                    </tr>
                </table>
            </td>
            <td style="width: 30%; ">

            </td>
        </tr>
    </table>
    <table style="width: 100%;">
        <tr>
            <td style="width: 100%; text-align: left; ">
                <p> <b> ক্রমিক নং- {{ $chalan->custom_counter }}</b></p>
            </td>
        </tr>
    </table>

    <table style="width: 100%; background-color: rgba(195,193,212,0.48) ">
        <tr style="width: 100%">
            <td style="width: 50%; text-align: left;">
                <p> <b> ড্রাইভারের নাম- {{ $chalan->driver_name ?? ''  }}</b></p>
            </td>
            <td style="width: 25%; text-align: left; ">
                <p> <b> গাড়ী নং- {{ $chalan->car_number ?? '' }}</b></p>
            </td>
            <td style="width: 25%; text-align: right; ">
                <p> <b> তারিখ- {{ $chalan->created_at->format('d/m/Y') ?? '--' }}</b></p>
            </td>
        </tr>
    </table>
    <table style="width: 100%; background-color: rgba(195,193,212,0.48) ">
        <tr style="width: 100%">
            <td style="width: 60%; text-align: left; ">
                <p> <b> স্থান- {{ $chalan->toBranch->name ?? '--' }}</b></p>
            </td>
            <td style="width: 40%; text-align: right; ">
                <p> <b> মোবাইল নং-{{ $chalan->driver_phone ?? '' }}</b></p>
            </td>
        </tr>
    </table>
</div>
<hr>
<div class="row">
    <table style="text-align: center;">
        <tr style="width: 100%;">
            <th style="width: 1cm;">
                ক্র নং
            </th style="width: 4cm;">
            <th style="width: 6cm;">
                প্রাপকের নাম
            </th>
            <th style="width: 8cm;">
                বিল নং
            </th>
            <th style="width: 10cm;">
                মালের নাম
            </th style="width: 1cm;">
            <th>
                সংখ্যা
            </th>
            <th style="width: 2cm;">
                অগ্রীম ভাড়া
            </th>
            <th style="width: 2cm;">
                বাকি ভাড়া
            </th>
            <th style="width: 1cm;">
                মন্তব্য
            </th>
        </tr>
        @foreach($chalan->invoices as $invoice)
            <tr @if($loop->even) style="width: 100%; background-color: #cec5c5" @else style="width: 100%; background-color: rgba(206,197,197,0.21)" @endif>
                <td>
                    {{ $loop->iteration }}
                </td>
                <td style="font-size: 22px; text-align: left;">
                    {{ $invoice->receiver->name ?? '' }}
                </td>
                <td>
                    <b style="font-size: 30px;">{{ en_to_bn($invoice->custom_counter) }}/{{ en_to_bn($invoice->created_at->format('d/m/Y')) }}</b>
                </td>
                <td style="text-align: left; font-size: 22px;"><pre style="text-align: left;">{{ $invoice->description ?? '' }}</pre></td>
                <td  style="font-size: 22px;">
                    {{ en_to_bn($invoice->quantity) }}
                </td>
                <td style="font-size: 22px;">
                    {{ en_to_bn($invoice->paid) }}
                </td>
                <td style="font-size: 22px;">
                    {{  en_to_bn($invoice->price +  $invoice->home +  $invoice->labour - $invoice->paid) }}
                </td>
                <td>
                </td>
            </tr>
        @endforeach
    </table>
    <div style="text-align: right; width:100%;">
        <b>মোটঃ  {{ en_to_bn($chalan->invoices->sum('paid')) }} &nbsp; {{ en_to_bn($chalan->invoices->sum('price') + $chalan->invoices->sum('home') + $chalan->invoices->sum('labour') - $chalan->invoices->sum('paid')) }} &nbsp; <br>   সর্ব মোটঃ {{ $chalan->invoices->sum('paid') + $chalan->invoices->sum('price') + $chalan->invoices->sum('home') + $chalan->invoices->sum('labour') - $chalan->invoices->sum('paid') }}&nbsp; </b>
    </div>

    <table style="width:100%; margin-top: 5px;">
        <tr style="width: 100%;">
            <td style="background-color: rgba(139,0,0,0.04); width: 100%; text-align: center;">
                <i>বিঃ দ্রঃ- দস্তখতকারী ড্রাইভার মালামালের জন্য দায়ী রহিলাম ।</i>
            </td>
        </tr>
    </table>
    <table style="width:100%; margin-top: 5px;">
        <tr style="width: 100%;">
            <td style=" width: 50%; text-align: left;">
                ড্রাইভারের স্বাক্ষর
            </td>
            <td style="width: 50%; text-align: right;">
                ভারপ্রাপ্ত কর্মকর্তার স্বাক্ষর
            </td>
        </tr>
    </table>
    <br>
    <br>
    <table style="width:100%; margin-top: 5px;">
        <tr style="width: 100%;">
            <td style="background-color: rgba(139,0,0,0.04); width: 100%;">
                {!! $chalan->chalan_note ?? '' !!}
            </td>
        </tr>
    </table>
</div>
</body>
</html>



