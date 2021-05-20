<?php

namespace App\Http\Controllers\Backend\Manager;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\CustomerAndBranch;
use App\Models\Invoice;
use App\Models\Sender;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use niklasravnsborg\LaravelPdf\Facades\Pdf as PDF;



class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = 'All';
        $branch_name = 'All';
        $invoices = auth()->user()->branch->fromInvoices()->orderBy('id', 'desc')->paginate(100);
        return view('backend.manager.invoice.index', compact('invoices', 'status', 'branch_name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $linked_branches = auth()->user()->branch->fromLinkedBranchs;
        return view('backend.manager.invoice.create', compact('linked_branches'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function store(Request $request)
    {
        $request->validate([
           'sender_name'        =>  'required|string',
           'receiver_name'      =>  'required|string',
           'receiver_phone'     =>  'nullable|string',
           'receiver_email'     =>  'nullable|email',
           'branch'             =>  'required|exists:branches,id',
           'description'        =>  'required|string',
           'quantity'           =>  'required|string|min:0',
           'price'              =>  'required|string|min:0',
           'advance'            =>  'required|string|min:0',
           'home'               =>  'required|string|min:0',
           'labour'             =>  'required|string|min:0',
        ]);

        //# Step 0 CHECK TO_BRANCH IS VALID OR NOT
        if (!check_branch_link(auth()->user()->branch->id, $request->branch)){
            return response()->json([
                'type' => 'error',
                'message' => 'Branch are not linked. Contact with admin.',
            ]);
        }

        //# Step 1 CUSTOMER
        $customer = null;
        //যদি এই তথ্যের সাথে মিলে কাস্টমার না থাকে তাহলে নতুন কাস্টমার তৈরি হবে
        if ($request->receiver_phone){  // ফোন নাম্বার পায় তাহলে সেই ফোন নাম্বারের আন্ডারে হবে
            $customer = User::where('phone', $request->receiver_phone)->first();
        }

        if(!$customer && $request->receiver_email){ // যদি ফোন নাম্বার না পেয়ে ইমেইল পায় তাহলে সেই ইমেইল এর আন্ডারে হবে
            $customer = User::where('email', $request->receiver_email)->first();
        }

        if(!$customer && $request->receiver_name){ //যদি ফোন নাম্বার এবং ইমেইল না পায় তাহলে নামের আন্ডারে হওয়ার চেষ্টা করবে
            $customer = User::where('name', $request->receiver_name)->where('phone', null)->where('email', null)->first();
        }

        if(!$customer){ //যদি কোন নাম্বার ইমেইল এবং নাম কোনটির সাথে মিলে না পাওয়া যায় তাহলে নতুন তৈরি হবে
            $customer = new User();
            $customer->name = $request->receiver_name;
            $customer->email = $request->receiver_email;
            $customer->phone = bn_to_en($request->receiver_phone);
            $customer->password = Str::random(20);
            $customer->creator_id = auth()->user()->id;
            try {
                $customer->save();
            }catch (\Exception $exception){
                return response()->json([
                    'type' => 'error',
                    'message' => $exception->getMessage(),
                ]);
            }
        }

        //# Step 2 LINKED
        //কাস্টমার যদি এই ব্রাঞ্চ এর সাথে যুক্ত হয়ে না থাকে তাহলে যুক্ত হয়ে যাবে
        $customer_and_branch = CustomerAndBranch::firstOrCreate(
            ['user_id' => $customer->id],
            ['branch_id' => auth()->user()->branch->id]
        );

        //# Step 3 INVOICE
        //এখন কাস্টমারের আইডি নিয়ে ভাউচার তৈরি করা হবে
        $invoice = new Invoice();

        $invoice->status            = 'Received';     //Received|On Going|Delivered

        $invoice->from_branch_id    = auth()->user()->branch->id;
        $invoice->to_branch_id      = $request->branch;
        $invoice->sender_name       = $request->sender_name;
        $invoice->receiver_id       = $customer->id;

        $invoice->description       = $request->description;
        $invoice->quantity          = bn_to_en($request->quantity);
        $invoice->price             = bn_to_en($request->price);
        $invoice->home              = bn_to_en($request->home);
        $invoice->labour            = bn_to_en($request->labour);
        $invoice->paid              = bn_to_en($request->advance);

        $invoice->creator_id        = auth()->user()->id;

        //Logic for custom counter
        $custom_counter = Invoice::where('from_branch_id', auth()->user()->branch->id)->orderBy('id', 'desc')->first()->custom_counter ?? 0;
        if ($custom_counter >= auth()->user()->branch->custom_inv_counter_max_value){
            $custom_counter = auth()->user()->branch->custom_inv_counter_min_value;
        }else{
            $custom_counter++;
        }

        $invoice->custom_counter        = $custom_counter;

        try {
            $invoice->creator_ip        = geoip()->getClientIP();
            $invoice->creator_browser   = get_client_browser();
            $invoice->creator_device    = get_client_device();
            $invoice->creator_os        = get_client_os();
            $invoice->creator_location  = geoip()->getLocation(geoip()->getClientIP())->city;
        }catch (\Exception $exception){

        }

        //# Step 4 SMS
        try {
            $invoice->save();

        }catch (\Exception $exception){
            return response()->json([
                'type' => 'error',
                'message' => $exception->getMessage(),
            ]);
        }

        return response()->json([
            'type' => 'success',
            'message' => 'Successfully done',
            'url' => route('manager.invoice.show', $invoice),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        if ($invoice->from_branch_id == auth()->user()->branch->id || $invoice->to_branch_id == auth()->user()->branch->id){
//            if ($invoice->fromBranch->invoice_style == 'A5'){
                $pdf = PDF::loadView('backend.pdf.a-5-one', compact('invoice'));
//            }else if ($invoice->fromBranch->invoice_style == 'A4'){
//                $pdf = PDF::loadView('backend.pdf.a4', compact('invoice'));
//            }
            return $pdf->stream('Invoice-'.config('app.name').'-('.$invoice->fromBranch->company->name.'- invoice code-'.$invoice->barcode.').pdf');
        }else{
            return back()->withErrors('Your are not permitted to check this invoice.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        $linked_branches = auth()->user()->branch->fromLinkedBranchs;
        return view('backend.manager.invoice.edit', compact('linked_branches', 'invoice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        if ($invoice->from_branch_id == auth()->user()->branch->id || $invoice->to_branch_id == auth()->user()->branch->id){
            try {
                $invoice->delete();
                return response()->json([
                    'type' => 'success',
                    'message' => ''
                ]);
            }catch (\Exception$exception){
                return response()->json([
                    'type' => 'error',
                    'message' => ''
                ]);
            }
        }else{
            return back()->withErrors('Your are not permitted to check this invoice.');
        }
    }

    public function senderName(Request $request)
    {
        if ($request->ajax()){
            return Invoice::groupBy('sender_name')
                ->where('from_branch_id', auth()->user()->branch->id)
                ->where('sender_name', 'LIKE', '%'. $request->name. '%')
                ->select('sender_name')
                ->get();
        }else{
            return redirect()->back()->withErrors('Request no allowed');
        }
    }

    public function receiverInfo(Request $request)
    {
        if ($request->ajax()){
            if ($request->search_type == 'name'){
                return Invoice::groupBy('receiver_id')
                    ->where('from_branch_id', auth()->user()->branch->id)
                    ->join('users', 'invoices.receiver_id', '=', 'users.id')
                    ->where('name', 'LIKE', '%'. $request->name. '%')
                    ->select('name', 'phone', 'email', 'to_branch_id')
                    ->get();
            }else if($request->search_type == 'phone'){
                return Invoice::groupBy('receiver_id')
                    ->where('from_branch_id', auth()->user()->branch->id)
                    ->join('users', 'invoices.receiver_id', '=', 'users.id')
                    ->where('phone', 'LIKE', '%'. $request->phone. '%')
                    ->select('name', 'phone', 'email', 'to_branch_id')
                    ->get();
            }else if($request->search_type == 'email'){
                return Invoice::groupBy('receiver_id')
                    ->where('from_branch_id', auth()->user()->branch->id)
                    ->join('users', 'invoices.receiver_id', '=', 'users.id')
                    ->where('email', 'LIKE', '%'. $request->email. '%')
                    ->select('name', 'phone', 'email', 'to_branch_id')
                    ->get();
            }
        }else{
            return redirect()->back()->withErrors('Request no allowed');
        }
    }

    public function statusConstant($status)
    {
        if ($status == 'received'){
            $status = 'Received';
        }elseif ($status == 'on-going'){
            $status = 'On Going';
        }elseif ($status == 'delivered'){
            $status = 'Delivered';
        }
        $branch_name = 'All';
        $invoices = auth()->user()->branch->fromInvoices()->where('status', $status)->orderBy('id', 'desc')->paginate(100);
        return view('backend.manager.invoice.index', compact('invoices', 'status', 'branch_name'));
    }

    public function statusAndBranchConstant($status, Branch $branch)
    {
        if ($branch->company_id != auth()->user()->company->id){
            return back()->withErrors('Your are not permitted to access.');
        }
        $branch_name = $branch->name;
        if ($status == 'received'){
            $status = 'Received';
        }elseif ($status == 'on-going'){
            $status = 'On Going';
        }elseif ($status == 'delivered'){
            $status = 'Delivered';
        }elseif ($status == 'all'){
            $invoices = auth()->user()->branch->fromInvoices()->where('to_branch_id', $branch->id)->orderBy('id', 'desc')->paginate(100);
            return view('backend.manager.invoice.index', compact('invoices', 'status', 'branch_name'));
        }else{
            return back()->withErrors('Invalid status.');
        }
        $invoices = auth()->user()->branch->fromInvoices()->where('status', $status)->where('to_branch_id', $branch->id)->orderBy('id', 'desc')->paginate(100);
        return view('backend.manager.invoice.index', compact('invoices', 'status', 'branch_name'));
    }

    public function makeAsDelivered(Request $request)
    {
        $request->validate([
            'invoices' => 'required',
        ]);

        $invoice_counter = 0;
        foreach(explode(',', $request->invoices) as $invoice_id){
            $invoice = Invoice::findOrFail($invoice_id);
            //ইনভয়েসের ভ্যালিডেশন চেক হচ্ছে যে ইনভয়েস টি এই ব্রাঞ্চ থেকেই তৈরি করা হয়েছে কিনা
            if ($invoice !=null && $invoice->from_branch_id == auth()->user()->branch->id && $invoice->status == 'Received'){
                $invoice_counter++;
            }
        }

        if($invoice_counter >! 0){
            return response()->json([
                'type' => 'error',
                'message' => 'Chose your invoice items.',
            ]);
        }

        foreach(explode(',', $request->invoices) as $invoice_id){
            $invoice = Invoice::findOrFail($invoice_id);
            //ইনভয়েসের ভ্যালিডেশন চেক হচ্ছে যে ইনভয়েস টি এই ব্রাঞ্চ থেকেই তৈরি করা হয়েছে কিনা
            if ($invoice !=null && $invoice->from_branch_id == auth()->user()->branch->id && $invoice->status == 'On Going'){
                $invoice->status = 'Delivered';
                $invoice->save();
            }
        }

        return response()->json([
            'type' => 'success',
            'message' => 'Successfully status changed',
        ]);
    }

    public function makeAsDeleted(Request $request)
    {
        $request->validate([
            'invoices' => 'required',
        ]);

        $invoice_counter = 0;
        foreach(explode(',', $request->invoices) as $invoice_id){
            $invoice = Invoice::findOrFail($invoice_id);
            //ইনভয়েসের ভ্যালিডেশন চেক হচ্ছে যে ইনভয়েস টি এই ব্রাঞ্চ থেকেই তৈরি করা হয়েছে কিনা
            if ($invoice !=null && $invoice->from_branch_id == auth()->user()->branch->id){
                $invoice_counter++;
            }
        }

        if($invoice_counter >! 0){
            return response()->json([
                'type' => 'error',
                'message' => 'Chose your invoice items.',
            ]);
        }

        foreach(explode(',', $request->invoices) as $invoice_id){
            $invoice = Invoice::findOrFail($invoice_id);
            //ইনভয়েসের ভ্যালিডেশন চেক হচ্ছে যে ইনভয়েস টি এই ব্রাঞ্চ থেকেই তৈরি করা হয়েছে কিনা
            if ($invoice !=null && $invoice->from_branch_id == auth()->user()->branch->id){
                $invoice->delete();
            }
        }

        return response()->json([
            'type' => 'success',
            'message' => 'Successfully deleted',
        ]);
    }
}
