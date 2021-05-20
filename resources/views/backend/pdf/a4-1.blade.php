<html>
<head>




    <style>
        @page {
            margin-top: 2.5cm;
            margin-bottom: 2.5cm;
            margin-left: 2cm;
            margin-right: 2cm;
            footer: html_letterfooter2;
            background-color: pink;
        }

        @page :first {
            margin-top: 8cm;
            margin-bottom: 4cm;
            header: html_letterheader;
            footer: _blank;
            resetpagenum: 1;
            background-color: lightblue;
        }

        @page letterhead {
            margin-top: 2.5cm;
            margin-bottom: 2.5cm;
            margin-left: 2cm;
            margin-right: 2cm;
            footer: html_letterfooter2;
            background-color: pink;
        }

        @page letterhead :first {
            margin-top: 8cm;
            margin-bottom: 4cm;
            header: html_letterheader;
            footer: _blank;
            resetpagenum: 1;
            background-color: lightblue;
        }
    </style>

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

    </style>
</head>
<body>
<htmlpageheader name="letterheader">
    <table width="100%" style=" font-family: sans-serif;">
        <tr>
            <td width="50%" style="color:#0000BB; ">
                <span style="font-weight: bold; font-size: 14pt;">Acme Trading Co.</span><br />
                123 Anystreet<br />Your City<br />GD12 4LP<br />
                <span style="font-size: 15pt;">☎</span> 01777 123 567
            </td>
            <td width="50%" style="text-align: right; vertical-align: top;">
                Invoice No.<br />
                <span style="font-weight: bold; font-size: 12pt;">0012345</span>
            </td>
        </tr>
    </table>

    <div style="margin-top: 1cm; text-align: right; font-family: sans-serif;">
        {DATE jS F Y}
    </div>
</htmlpageheader>

<htmlpagefooter name="letterfooter2">
    <div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; font-family: sans-serif; ">
        Page {PAGENO} of {nbpg}
    </div>
</htmlpagefooter>
<div style="text-align: right">Date: 13th November 2008</div>
<table width="100%" style="font-family: serif;" cellpadding="10">
    <tr>
        <td width="45%" style="border: 0.1mm solid #888888; "><span
                style="font-size: 7pt; color: #555555; font-family: sans;">SOLD TO:</span><br/><br/>345
            Anotherstreet<br/>Little Village<br/>Their City<br/>CB22 6SO
        </td>
        <td width="10%">&nbsp;</td>
        <td width="45%" style="border: 0.1mm solid #888888;"><span
                style="font-size: 7pt; color: #555555; font-family: sans;">SHIP TO:</span><br/><br/>345
            Anotherstreet<br/>Little Village<br/>Their City<br/>CB22 6SO
        </td>
    </tr>
</table>
<br/>
<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
    <thead>
    <tr>
        <td width="15%">Ref. No.</td>
        <td width="10%">Quantity</td>
        <td width="45%">Description</td>
        <td width="15%">Unit Price</td>
        <td width="15%">Amount</td>
    </tr>
    </thead>
    <tbody>
    <!-- ITEMS HERE -->
    <tr>
        <td align="center">MF1234567</td>
        <td align="center">10</td>
        <td>Large pack Hoover bags</td>
        <td class="cost">&pound;2.56</td>
        <td class="cost">&pound;25.60</td>
    </tr>
    <tr>
        <td align="center">MF1234567</td>
        <td align="center">10</td>
        <td>
            Large pack Hoover bags <br>
            Large pack Hoover bags <br>
            Large pack Hoover bags <br>
            Large pack Hoover bags <br>
            Large pack Hoover bags <br>
            Large pack Hoover bags <br>
            Large pack Hoover bags <br>
            Large pack Hoover bags <br>
            Large pack Hoover bags <br>
            Large pack Hoover bags <br>
        </td>
        <td class="cost">&pound;2.56</td>
        <td class="cost">&pound;25.60</td>
    </tr>

    <!-- END ITEMS HERE -->
    <tr>
        <td class="blanktotal" colspan="3" rowspan="6"></td>
        <td class="totals">Subtotal:</td>
        <td class="totals cost">&pound;1825.60</td>
    </tr>
    <tr>
        <td class="totals">Tax:</td>
        <td class="totals cost">&pound;18.25</td>
    </tr>
    <tr>
        <td class="totals">Shipping:</td>
        <td class="totals cost">&pound;42.56</td>
    </tr>
    <tr>
        <td class="totals"><b>TOTAL:</b></td>
        <td class="totals cost"><b>&pound;1882.56</b></td>
    </tr>
    <tr>
        <td class="totals">Deposit:</td>
        <td class="totals cost">&pound;100.00</td>
    </tr>
    <tr>
        <td class="totals"><b>Balance due:</b></td>
        <td class="totals cost"><b>&pound;1782.56</b></td>
    </tr>
    </tbody>
</table>
<div style="text-align: center; font-style: italic;">Payment terms: payment due in 30 days</div>

</body>
</html>
