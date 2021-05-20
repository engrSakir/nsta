{{--https://mpdf.github.io/real-life-examples/letterhead-letters.html--}}
<html>
<head>
    <title> {{  __('Invoice') }} | {{ config('app.name') }}</title>
    <link href="{{ asset('assets/backend/pdf-css/invoice-a5.css') }}" rel="stylesheet" type="text/css">
    <style>
        p {
            margin: 0pt;
        }

        table.items {
            border: 0.1mm solid #000000;
        }

        td {
            vertical-align: top;
        }

        .items td {
            border-left: 0.1mm solid #000000;
            border-right: 0.1mm solid #000000;
        }

        table thead td {
            background-color: #EEEEEE;
            text-align: center;
            border: 0.1mm solid #000000;
            font-variant: small-caps;
        }

        .items td.blanktotal {
            background-color: #EEEEEE;
            border: 0.1mm solid #000000;
            background-color: #FFFFFF;
            border: 0mm none #000000;
            border-top: 0.1mm solid #000000;
            border-right: 0.1mm solid #000000;
        }

        .items td.totals {
            text-align: right;
            border: 0.1mm solid #000000;
        }

        .items td.cost {
            text-align: "." center;
        }

        body {
            font-family: bengali_englisg, sans-serif;
            font-size: 10pt;
        }
    </style>
</head>
<body>
{{--<htmlpageheader name="page-header">--}}
{{--    <h1>Header : Page {PAGENO}</h1>--}}
{{--</htmlpageheader>--}}
<htmlpagefooter name="page-footer">
    <div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 0mm; ">
        Page {PAGENO} of {nb}
    </div>
</htmlpagefooter>
{{--Company Information--}}
<table width="100%" cellpadding="10">
    <tr>
        <td width="10%">
            <img src="{{ asset('uploads/images/company/logo/logo.png') }}" alt="" style="width: 130px">
        </td>
        <td width="80%" style="text-align: center">
            <h1>Company name ( কোম্পানির নাম )</h1>
            <b>আন্তঃজেলা স্থল পথে মাল পরিবহন ঢাকা মহানগর পণ্য পরিবহন এজেন্সি মালিক সমিতির অন্তর্ভুক্ত হয়েছে</b>
            <p>আন্তঃজেলা স্থল পথে মাল পরিবহন ঢাকা মহানগর পণ্য পরিবহন এজেন্সি মালিক সমিতির অন্তর্ভুক্ত হয়েছে</p>
        </td>
        <td width="10%">
            <img src="{{ asset('uploads/images/company/logo/logo.png') }}" alt="" style="width: 130px">
        </td>
    </tr>
</table>
{{--Sender and receiver informaion--}}
<table width="100%" cellpadding="10">
    <tr>
        <td width="45%" style="border: 0.1mm solid #888888; ">
            <span style="font-size: 7pt; color: #555555;">প্রেরক:</span>
            <br/><br/>
            নামঃ উদাহরণ নাম
            <br/>
            থিকানাঃ উদাহরণ থিকানা
            <br/>

            <br/>
        </td>
        <td width="10%">&nbsp;</td>
        <td width="45%" style="border: 0.1mm solid #888888;">
            <span style="font-size: 7pt; color: #555555;">প্রাপক:</span>
            <br/><br/>
            নামঃ উদাহরণ নাম
            <br/>
            থিকানাঃ উদাহরণ থিকানা
            <br/>
            মোবাইলঃ উদাহরণ থিকানা
            <br/>

        </td>
    </tr>
</table>

<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; margin-top: 0.2cm;" cellpadding="8">
    <thead>
    <tr>
        <td width="10%">Quantity</td>
        <td width="75%">Description</td>
        <td width="15%">Price</td>
    </tr>
    </thead>
    <tbody>
    <!-- ITEMS HERE -->
    <tr>
        <td align="center" style="height: 6cm;">
            16
        </td>
        <td>
            Line number 1 <br>
            Line number 2 <br>
            Line number 3 <br>
            Line number 4 <br>
            Line number 5 <br>
            Line number 6 <br>
            Line number 7 <br>
            Line number 8 <br>
            Line number 9 <br>
            Line number 10 <br>
            Line number 11 <br>
            Line number 12 <br>
            Line number 13 <br>
            Line number 14 <br>
            Line number 15 <br>
            Line number 16 <br>
        </td>
        <td class="cost">
            1500
        </td>
    </tr>
    <!-- END ITEMS HERE -->
    </tbody>
</table>
<table width="100%">
    <tr>
        <td width="10%" style="text-align: right;">
            ডেলিভারি
        </td>
        <td width="10%">
            100
        </td>
        <td width="10%" style="text-align: right;">
            লেবার
        </td>
        <td width="10%">
            200
        </td>
        <td width="10%" style="text-align: right;">
            মোট
        </td>
        <td width="10%">
            300
        </td>
        <td width="10%" style="text-align: right;">
            অগ্রিম
        </td>
        <td width="10%">
            400
        </td>
        <td width="10%" style="text-align: right;">
            বাকি
        </td>
        <td width="10%">
            500
        </td>
    </tr>
</table>
</body>
</html>
