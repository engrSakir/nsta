<?php

namespace App\Http\Controllers\Backend\Customer;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf as PDF;

class DashboardController extends Controller
{
    public function index(){
        $invoices = auth()->user()->getInvoiceAsCustomer()->orderBy('id', 'desc')->paginate(100);
        return view('backend.customer.invoice.index', compact('invoices'));
    }

    public function invoiceShow(Invoice $invoice){
        if($invoice->receiver_id != auth()->user()->id){
            return back()->withErrors('Your are not permitted to check this invoice.');
        }
        $pdf = PDF::loadView('backend.pdf.invoice', compact('invoice'));
        return $pdf->stream('Invoice-'.config('app.name').'-('.$invoice->fromBranch->company->name.'- invoice code-'.$invoice->custom_counter.').pdf');;
    }

    public function invoiceDownload(Invoice $invoice){
        if($invoice->receiver_id != auth()->user()->id){
            return back()->withErrors('Your are not permitted to check this invoice.');
        }
        $pdf = PDF::loadView('backend.pdf.invoice', compact('invoice'));
        return $pdf->download('Invoice-'.config('app.name').'-('.$invoice->fromBranch->company->name.'- invoice code-'.$invoice->custom_counter.').pdf');;
    }
}
