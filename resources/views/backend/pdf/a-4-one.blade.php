<html>
<head>
    <style>
        body {
            font-family: sans-serif;
            font-size: 10pt;
        }

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
        .m-5 {
            margin: -5px;
        }
        .m-1 {
            margin: -1px;
        }
    </style>
</head>
<body>
<!--mpdf
<htmlpagefooter name="myfooter">
<div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
Page {PAGENO} of {nb}
</div>
</htmlpagefooter>
<sethtmlpagefooter name="myfooter" value="on" />
mpdf-->
<div style="text-align: center">
    <h4 class="m-1"><b>Entry Chalan</b></h4>
    <img src="{{ asset($chalan->fromBranch->company->logo ?? get_static_option('no_image')) }}" width="17%" height="50px">
    <h2 class="m-1"><b>{{ $chalan->fromBranch->company->name ?? '' }}</b></h2>
    <b class="m-5">{!! $chalan->fromBranch->chalan_heading_one ?? '' !!}</b>
    <p class="m-5">{!! $chalan->fromBranch->chalan_heading_two ?? ''  !!}</p>
    <p class="m-5">{!! $chalan->fromBranch->chalan_heading_three ?? ''  !!}</p>
</div>
<br>

<table width="100%" style="font-family: serif;" cellpadding="10">
    <tr>
        <td width="45%" style="border: 0.1mm solid #888888; ">
            No.: {{ $chalan->custom_counter ?? '--' }}<br/>
            Date: {{ $chalan->created_at->format('d/m/Y') ?? '--' }}<br/>
            Office: {{ $chalan->toBranch->name ?? '--' }}
        </td>
        <td width="10%">&nbsp;</td>
        <td width="45%" style="border: 0.1mm solid #888888;">
            Driver Name: {{ $chalan->driver_name ?? '--' }}<br/>
            Phone: {{ $chalan->driver_phone ?? '--' }}<br/>
            Car: {{ $chalan->car_number ?? '--' }}
        </td>
    </tr>
</table>
<br/>
<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
    <thead>
    <tr>
        <td width="5%">#</td>
        <td width="20%">Sender</td>
        <td width="15%">Number</td>
        <td width="32%">Description</td>
        <td width="8%">QT</td>
        <td width="10%">Advance</td>
        <td width="10%">Due</td>
    </tr>
    </thead>
    <tbody>
    <!-- ITEMS HERE -->
    @foreach($chalan->invoices as $invoice)
        <tr @if($loop->even) style="background-color:rgba(156,156,156,0.2)" @endif>
            <td align="center">{{ $loop->iteration }}</td>
            <td align="center">{{ $invoice->sender_name ?? '--' }}</td>
            <td align="center">{{ $invoice->custom_counter ?? '--' }}/{{ $invoice->created_at->format('d/m/Y') }}</td>
            <td>{{ $invoice->description ?? '--' }}</td>
            <td align="center">{{ $invoice->quantity ?? '--' }}</td>
            <td class="cost">{{ $invoice->paid ?? '--' }}</td>
            <td class="cost">{{  $invoice->price +  $invoice->home +  $invoice->labour - $invoice->paid }}</td>
        </tr>
    @endforeach
    <!-- END ITEMS HERE -->
    <tr>
        <td class="blanktotal" colspan="3" rowspan="1"></td>
        <td class="totals"><b>TOTAL:</b></td>
        <td class="totals"><b>{{ $chalan->invoices->sum('quantity') }}</b></td>
        <td class="totals"><b>{{ $chalan->invoices->sum('paid') }}</b></td>
        <td class="totals cost">
            <b>{{ $chalan->invoices->sum('price') + $chalan->invoices->sum('home') + $chalan->invoices->sum('labour') - $chalan->invoices->sum('paid') }}</b>
        </td>
    </tr>
    </tbody>
</table>
<div style="text-align: center; font-style: italic;">Payment terms: payment due in 30 days</div>
</body>
</html>
