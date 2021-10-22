<?php

namespace App\Http\Controllers\Backend\Manager;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\CustomerAndBranch;
use App\Models\Invoice;
use App\Models\Sender;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
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
        $invoices = auth()->user()->branch->fromInvoices()->where('status', 'Received')->get();
        return view('backend.manager.invoice.create', compact('linked_branches', 'invoices'));
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
            'condition_amount'   => 'required_with_all:condition',
            'condition_charge'   => 'required_with_all:condition',
            'sender_phone'       =>  'nullable|string',
            'description'        =>  'required|string',
            //            'quantity'           =>  'string|min:0',
            'price'              =>  'required|string|min:0',
            //            'advance'            =>  'string|min:0',
            //            'home'               =>  'string|min:0',
            //            'labour'             =>  'string|min:0',
        ]);

        //# Step 0 CHECK TO_BRANCH IS VALID OR NOT
        if (!check_branch_link(auth()->user()->branch->id, $request->branch)) {
            return response()->json([
                'type' => 'error',
                'message' => 'Branch are not linked. Contact with admin.',
            ]);
        }

        //# Step 1 CUSTOMER
        $customer = null;
        //যদি এই তথ্যের সাথে মিলে কাস্টমার না থাকে তাহলে নতুন কাস্টমার তৈরি হবে
        if ($request->receiver_name) { //যদি ফোন নাম্বার এবং ইমেইল না পায় তাহলে নামের আন্ডারে হওয়ার চেষ্টা করবে
            $customer = User::where('name', $request->receiver_name)->whereRaw('LENGTH(phone) < 1')->first();
        }
        if ($request->receiver_phone) {  // ফোন নাম্বার পায় তাহলে সেই ফোন নাম্বারের আন্ডারে হবে
            $customer = User::where('phone', $request->receiver_phone)->first();
        }
        // if($request->receiver_email){ // যদি ফোন নাম্বার না পেয়ে ইমেইল পায় তাহলে সেই ইমেইল এর আন্ডারে হবে
        //     $customer = User::where('email', $request->receiver_email)->first();
        // }

        $password = null;
        if (!$customer) { //যদি কোন নাম্বার ইমেইল এবং নাম কোনটির সাথে মিলে না পাওয়া যায় তাহলে নতুন তৈরি হবে
            $password = Str::random(4);
            $customer = new User();
            $customer->name = $request->receiver_name;
            $customer->email = $request->receiver_email;
            $customer->phone = bn_to_en($request->receiver_phone);
            $customer->password = bcrypt($password);
            $customer->creator_id = auth()->user()->id;
            try {
                $customer->save();
            } catch (\Exception $exception) {
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
        $invoice->quantity          = $request->quantity;
        $invoice->price             = bn_to_en($request->price);
        $invoice->home              = bn_to_en($request->home);
        $invoice->labour            = bn_to_en($request->labour);
        $invoice->paid            = bn_to_en($request->advance);

        if ($request->condition) {
            $invoice->condition_amount          = bn_to_en($request->condition_amount);
            $invoice->condition_charge          = bn_to_en($request->condition_charge);
            $invoice->sender_phone              = bn_to_en($request->sender_phone);
        }

        $invoice->creator_id        = auth()->user()->id;

        //Logic for custom counter
        $custom_counter = Invoice::where('from_branch_id', auth()->user()->branch->id)->orderBy('id', 'desc')->first()->custom_counter ?? auth()->user()->branch->custom_inv_counter_min_value;

        if ($custom_counter < auth()->user()->branch->custom_inv_counter_min_value) {
            $custom_counter = auth()->user()->branch->custom_inv_counter_min_value;
        }

        if ($custom_counter >= auth()->user()->branch->custom_inv_counter_max_value) {
            $custom_counter = auth()->user()->branch->custom_inv_counter_min_value;
        } else {
            $custom_counter++;
        }

        $invoice->custom_counter        = $custom_counter;

        try {
            $invoice->creator_ip        = geoip()->getClientIP();
            $invoice->creator_browser   = get_client_browser();
            $invoice->creator_device    = get_client_device();
            $invoice->creator_os        = get_client_os();
            $invoice->creator_location  = geoip()->getLocation(geoip()->getClientIP())->city;
        } catch (\Exception $exception) {
        }

        //# Step 4 SMS and save
        //Get office wise latest information
        try {
            $invoice->save();
            $linked_branch_and_amount = [];
            foreach (auth()->user()->branch->fromInvoices()->where('status', 'Received')->get()->groupBy('to_branch_id') as $invoice_group => $invoice_items) {
                $lined_branch_name = Branch::find($invoice_group)->name ?? '#';
                $branch_url = url('/') . '/backend/manager/invoice/status/all/branch/' . $invoice_group;
                $total_of_this_office = $invoice_items->sum('price') + $invoice_items->sum('home') + $invoice_items->sum('labour');
                array_push($linked_branch_and_amount, [
                    'name' => $lined_branch_name ?? '#',
                    'total' => $total_of_this_office,
                    'url' => $branch_url
                ]);
            }

            if ($password) {
                $message = get_regular_invoice_message_content_for_new_customer($invoice, $password);
            } else {
                $message = get_regular_invoice_message_content_for_old_customer($invoice);
            }
            if ($invoice->receiver->phone != null && sms($invoice->receiver->phone, $message) == true) {
                return response()->json([
                    'type' => 'success',
                    'message' => 'ভাউচার তৈরি এবং কাস্টমারকে মেসেজে জানানো হয়েছে।',
                    'url' => route('manager.invoice.show', $invoice),
                    'invoice_id' => $invoice->id,
                    'offices' => $linked_branch_and_amount,
                ]);
            } else {
                return response()->json([
                    'type' => 'success',
                    'message' => 'ভাউচার তৈরি এবং কাস্টমারকে মেসেজ দেওয়া সম্ভব হয়নি।',
                    'url' => route('manager.invoice.show', $invoice),
                    'invoice_id' => $invoice->id,
                    'offices' => $linked_branch_and_amount,
                ]);
            }
        } catch (\Exception $exception) {
            return response()->json([
                'type' => 'error',
                'message' => $exception->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        if ($invoice->from_branch_id == auth()->user()->branch->id || $invoice->to_branch_id == auth()->user()->branch->id) {
            //            if ($invoice->fromBranch->invoice_style == 'A5'){
            $pdf = PDF::loadView('backend.pdf.invoice', compact('invoice'));
            //            }else if ($invoice->fromBranch->invoice_style == 'A4'){
            //                $pdf = PDF::loadView('backend.pdf.a4', compact('invoice'));
            //            }
            return $pdf->stream('Invoice-' . config('app.name') . '-(' . $invoice->fromBranch->company->name . '- invoice code-' . $invoice->barcode . ').pdf');
        } else {
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
        if (request()->ajax()) {
            return [
                'invoice_id'        => $invoice->id,
                'invoice_name'      => $invoice->sender_name,
                'invoice_phone'     => $invoice->sender_phone,
                'receiver_name'     => $invoice->receiver->name ?? 'Not Found',
                'receiver_phone'    => $invoice->receiver->phone ?? 'Not Found',
                'to_branch_id'      => $invoice->to_branch_id,
                'condition_amount'  => $invoice->condition_amount,
                'condition_charge'  => $invoice->condition_charge,
                'description'       => $invoice->description,
                'quantity'  => $invoice->quantity,
                'price'     => $invoice->price,
                'home'      => $invoice->home,
                'labour'    => $invoice->labour,
                'paid'      => $invoice->paid,
            ];
        }
        if ($invoice->from_branch_id == auth()->user()->branch->id) {
            $linked_branches = auth()->user()->branch->fromLinkedBranchs;
            return view('backend.manager.invoice.edit', compact('linked_branches', 'invoice'));
        } else {
            return back()->withErrors('Your are not permitted to check this invoice.');
        }
    }

    /**
     * @param Request $request
     * @param Invoice $invoice
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Invoice $invoice)
    {
        if ($invoice->from_branch_id != auth()->user()->branch->id) {
            return response()->json([
                'type' => 'error',
                'message' => 'Your are not permitted to update this invoice.',
            ]);
        }
        // return $request->input();
        $request->validate([
            'sender_name'        =>  'required|string',
            'receiver_name'      =>  'required|string',
            'receiver_phone'     =>  'nullable|string',
            'receiver_email'     =>  'nullable|email',
            'branch'             =>  'required|exists:branches,id',
            'condition_amount'   => 'required_with_all:condition',
            'condition_charge'   => 'required_with_all:condition',
            'sender_phone'       =>  'nullable|string',
            'description'        =>  'required|string',
            //            'quantity'           =>  'string|min:0',
            'price'              =>  'required|string|min:0',
            //            'advance'            =>  'string|min:0',
            //            'home'               =>  'string|min:0',
            //            'labour'             =>  'string|min:0',
        ]);

        //# Step 0 CHECK TO_BRANCH IS VALID OR NOT
        if (!check_branch_link(auth()->user()->branch->id, $request->branch)) {
            return response()->json([
                'type' => 'error',
                'message' => 'Branch are not linked. Contact with admin.',
            ]);
        }

        //# Step 1 CUSTOMER
        $customer = null;
        //যদি এই তথ্যের সাথে মিলে কাস্টমার না থাকে তাহলে নতুন কাস্টমার তৈরি হবে
        if ($request->receiver_name) { //যদি ফোন নাম্বার এবং ইমেইল না পায় তাহলে নামের আন্ডারে হওয়ার চেষ্টা করবে
            $customer = User::where('name', $request->receiver_name)->first();
        }
        if ($request->receiver_phone) {  // ফোন নাম্বার পায় তাহলে সেই ফোন নাম্বারের আন্ডারে হবে
            $customer = User::where('phone', $request->receiver_phone)->first();
        }
        if ($request->receiver_email) { // যদি ফোন নাম্বার না পেয়ে ইমেইল পায় তাহলে সেই ইমেইল এর আন্ডারে হবে
            $customer = User::where('email', $request->receiver_email)->first();
        }

        $password = null;
        if (!$customer) { //যদি কোন নাম্বার ইমেইল এবং নাম কোনটির সাথে মিলে না পাওয়া যায় তাহলে নতুন তৈরি হবে
            $password = Str::random(4);
            $customer = new User();
            $customer->name = $request->receiver_name;
            $customer->email = $request->receiver_email;
            $customer->phone = bn_to_en($request->receiver_phone);
            $customer->password = bcrypt($password);
            $customer->creator_id = auth()->user()->id;
            try {
                $customer->save();
            } catch (\Exception $exception) {
                return response()->json([
                    'type' => 'error',
                    'message' => $exception->getMessage(),
                ]);
            }
        }else{
            $customer->name = $request->receiver_name;
            $customer->email = $request->receiver_email;
            $customer->phone = bn_to_en($request->receiver_phone);
            $customer->save();
        }

        //# Step 2 LINKED
        //কাস্টমার যদি এই ব্রাঞ্চ এর সাথে যুক্ত হয়ে না থাকে তাহলে যুক্ত হয়ে যাবে
        $customer_and_branch = CustomerAndBranch::firstOrCreate(
            ['user_id' => $customer->id],
            ['branch_id' => auth()->user()->branch->id]
        );

        //# Step 3 INVOICE
        //এখন কাস্টমারের আইডি নিয়ে ভাউচার তৈরি করা হবে
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

        $invoice->updater_id        = auth()->user()->id;

        if ($request->condition) {
            $invoice->condition_amount              = bn_to_en($request->condition_amount);
            $invoice->condition_charge              = bn_to_en($request->condition_charge);
            $invoice->sender_phone              = bn_to_en($request->sender_phone);
        }
        //# Step 4 SMS
        try {
            $invoice->save();
            $linked_branch_and_amount = [];
            foreach (auth()->user()->branch->fromInvoices()->where('status', 'Received')->get()->groupBy('to_branch_id') as $invoice_group => $invoice_items) {
                $lined_branch_name = Branch::find($invoice_group)->name ?? '#';
                $branch_url = url('/') . '/backend/manager/invoice/status/all/branch/' . $invoice_group;
                $total_of_this_office = $invoice_items->sum('price') + $invoice_items->sum('home') + $invoice_items->sum('labour');
                array_push($linked_branch_and_amount, [
                    'name' => $lined_branch_name ?? '#',
                    'total' => $total_of_this_office,
                    'url' => $branch_url
                ]);
            }

            if ($password) {
                $message = get_regular_invoice_message_content_for_new_customer($invoice, $password);
                if ($invoice->receiver->phone != null && sms($invoice->receiver->phone, $message) == true) {
                    return response()->json([
                        'type' => 'success',
                        'message' => 'ভাউচার আপডেট হয়েছে এবং কাস্টমারকে মেসেজে জানানো হয়েছে।',
                        'url' => route('manager.invoice.show', $invoice),
                        'invoice_id' => $invoice->id,
                        'offices' => $linked_branch_and_amount,
                    ]);
                }
            }
        } catch (\Exception $exception) {
            return response()->json([
                'type' => 'error',
                'message' => $exception->getMessage(),
            ]);
        }

        return response()->json([
            'type' => 'success',
            'message' => 'ভাউচার আপডেট হয়েছে',
            'url' => route('manager.invoice.show', $invoice),
            'invoice_id' => $invoice->id,
            'offices' => $linked_branch_and_amount,
        ]);
    }

    /**
     * @param Invoice $invoice
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function destroy(Invoice $invoice)
    {
        if ($invoice->from_branch_id == auth()->user()->branch->id || $invoice->to_branch_id == auth()->user()->branch->id) {
            try {
                $invoice->delete();
                return response()->json([
                    'type' => 'success',
                    'message' => ''
                ]);
            } catch (\Exception $exception) {
                return response()->json([
                    'type' => 'error',
                    'message' => ''
                ]);
            }
        } else {
            return back()->withErrors('Your are not permitted to check this invoice.');
        }
    }

    public function senderName(Request $request)
    {
        if ($request->ajax()) {
            return Invoice::groupBy('sender_name')
                ->where('from_branch_id', auth()->user()->branch->id)
                ->where('sender_name', 'LIKE', '%' . $request->name . '%')
                ->select('sender_name', 'sender_phone')
                ->get();
        } else {
            return redirect()->back()->withErrors('Request no allowed');
        }
    }

    public function senderPhone(Request $request)
    {
        if ($request->ajax()) {
            return Invoice::groupBy('sender_phone')
                ->where('from_branch_id', auth()->user()->branch->id)
                ->where('sender_phone', 'LIKE', '%' . $request->phone . '%')
                ->select('sender_name', 'sender_phone')
                ->get();
        } else {
            return redirect()->back()->withErrors('Request no allowed');
        }
    }

    public function receiverInfo(Request $request)
    {
        if ($request->ajax()) {
            if ($request->search_type == 'name') {
                return Invoice::groupBy('receiver_id')
                    ->where('from_branch_id', auth()->user()->branch->id)
                    ->join('users', 'invoices.receiver_id', '=', 'users.id')
                    ->where('name', 'LIKE', '%' . $request->name . '%')
                    ->select('name', 'phone', 'email', 'to_branch_id')
                    ->get();
            } else if ($request->search_type == 'phone') {
                return Invoice::groupBy('receiver_id')
                    ->where('from_branch_id', auth()->user()->branch->id)
                    ->join('users', 'invoices.receiver_id', '=', 'users.id')
                    ->where('phone', 'LIKE', '%' . $request->phone . '%')
                    ->select('name', 'phone', 'email', 'to_branch_id')
                    ->get();
            } else if ($request->search_type == 'email') {
                return Invoice::groupBy('receiver_id')
                    ->where('from_branch_id', auth()->user()->branch->id)
                    ->join('users', 'invoices.receiver_id', '=', 'users.id')
                    ->where('email', 'LIKE', '%' . $request->email . '%')
                    ->select('name', 'phone', 'email', 'to_branch_id')
                    ->get();
            } else if ($request->search_type == 'custom_counter') {
                return Invoice::where('from_branch_id', auth()->user()->branch->id)
                    ->join('users', 'invoices.receiver_id', '=', 'users.id')
                    ->where('custom_counter', 'LIKE', '%' . $request->custom_counter . '%')
                    ->select('invoices.id as id', DB::raw('DATE_FORMAT(invoices.created_at, "%d/%m/%Y") as date'), 'custom_counter', 'status')
                    ->orderBy('id', 'desc')
                    ->get();
            }
        } else {
            return redirect()->back()->withErrors('Request no allowed');
        }
    }

    public function statusConstant($status)
    {
        $paginate = 100;

        if ($status == 'received') {
            $status = 'Received';
            $paginate = 1000;
        } elseif ($status == 'on-going') {
            $status = 'On Going';
        } elseif ($status == 'delivered') {
            $status = 'Delivered';
        }
        $branch_name = 'All';
        $invoices = auth()->user()->branch->fromInvoices()->where('status', $status)->orderBy('id', 'desc')->paginate($paginate);
        return view('backend.manager.invoice.index', compact('invoices', 'status', 'branch_name'));
    }

    public function statusAndBranchConstant($status, Branch $branch)
    {
        if ($branch->company_id != auth()->user()->company->id) {
            return back()->withErrors('Your are not permitted to access.');
        }
        $branch_name = $branch->name;
        $paginate = 100;
        if ($status == 'received') {
            $status = 'Received';
            $paginate = 1000;
        } elseif ($status == 'on-going') {
            $status = 'On Going';
        } elseif ($status == 'delivered') {
            $status = 'Delivered';
        } elseif ($status == 'all') {
            $invoices = auth()->user()->branch->fromInvoices()->where('to_branch_id', $branch->id)->orderBy('id', 'desc')->paginate($paginate);
            return view('backend.manager.invoice.index', compact('invoices', 'status', 'branch_name'));
        } else {
            return back()->withErrors('Invalid status.');
        }
        $invoices = auth()->user()->branch->fromInvoices()->where('status', $status)->where('to_branch_id', $branch->id)->orderBy('id', 'desc')->paginate($paginate);
        return view('backend.manager.invoice.index', compact('invoices', 'status', 'branch_name'));
    }

    public function makeAsDelivered(Request $request)
    {
        $request->validate([
            'invoices' => 'required',
        ]);

        $invoice_counter = 0;
        foreach (explode(',', $request->invoices) as $invoice_id) {
            $invoice = Invoice::findOrFail($invoice_id);
            //ইনভয়েসের ভ্যালিডেশন চেক হচ্ছে যে ইনভয়েস টি এই ব্রাঞ্চ থেকেই তৈরি করা হয়েছে কিনা
            if ($invoice != null && $invoice->from_branch_id == auth()->user()->branch->id && $invoice->status == 'On Going') {
                $invoice_counter++;
            }
        }

        if ($invoice_counter < 1) {
            return response()->json([
                'type' => 'error',
                'message' => 'দয়া করে গাড়িতে থাকা ভাউচার সমূহ থেকে পছন্দ করেন.',
            ]);
        }

        foreach (explode(',', $request->invoices) as $invoice_id) {
            $invoice = Invoice::findOrFail($invoice_id);
            //ইনভয়েসের ভ্যালিডেশন চেক হচ্ছে যে ইনভয়েস টি এই ব্রাঞ্চ থেকেই তৈরি করা হয়েছে কিনা
            if ($invoice != null && $invoice->from_branch_id == auth()->user()->branch->id && $invoice->status == 'On Going') {
                $invoice->status = 'Delivered';
                $invoice->save();
            }
        }

        return response()->json([
            'type' => 'success',
            'message' => 'Successfully status changed',
        ]);
    }

    //Only for conditional invoice
    public function makeAsBreak(Request $request)
    {
        $request->validate([
            'invoices' => 'required',
        ]);

        $invoice_counter = 0;
        foreach (explode(',', $request->invoices) as $invoice_id) {
            $invoice = Invoice::findOrFail($invoice_id);
            //ইনভয়েসের ভ্যালিডেশন চেক হচ্ছে যে ইনভয়েস টি এই ব্রাঞ্চ থেকেই তৈরি করা হয়েছে কিনা
            if ($invoice != null && $invoice->from_branch_id == auth()->user()->branch->id && $invoice->status == 'Delivered' && $invoice->condition_amount > 0) {
                $invoice_counter++;
            }
        }

        if ($invoice_counter  < 1) {
            return response()->json([
                'type' => 'error',
                'message' => 'কন্ডিশন ব্রেক করার জন্য দয়া করে ডেলিভারি সম্পন্ন হওয়া ভাউচার গুলো পছন্দ করুন।',
            ]);
        }

        $sent_sms_counter = 0;
        $condition_break_counter = 0;
        foreach (explode(',', $request->invoices) as $invoice_id) {
            $invoice = Invoice::findOrFail($invoice_id);
            //ইনভয়েসের ভ্যালিডেশন চেক হচ্ছে যে ইনভয়েস টি এই ব্রাঞ্চ থেকেই তৈরি করা হয়েছে কিনা
            if ($invoice != null && $invoice->from_branch_id == auth()->user()->branch->id && $invoice->status == 'Delivered' && $invoice->condition_amount > 0) {
                $invoice->status = 'Break';
                $invoice->save();
                $condition_break_counter++;
                // কন্ডিশন ভাঙ্গার সাথে সাথে মেসেজ পাঠানো
                if ($invoice->receiver->phone != null && sms($invoice->sender_phone, 'নিউ শাপলা ট্রান্সপোর্ট এজেন্সি থেকে আপনার কন্ডিশন টি সম্পূর্ণভাবে ভাঙ্গা হয়েছে। বুকিং নং- ' . $invoice->custom_counter) == true) {
                    $sent_sms_counter++;
                }
            }
        }

        return response()->json([
            'type' => 'success',
            'message' => 'কন্ডিশন ভাঙ্গা হয়েছে ' . $condition_break_counter . ' এবং মেসেজ পাঠানো হয়েছে ' . $sent_sms_counter . ' জনকে',
        ]);
    }

    public function makeAsDeleted(Request $request)
    {
        $request->validate([
            'invoices' => 'required',
        ]);

        $invoice_counter = 0;
        foreach (explode(',', $request->invoices) as $invoice_id) {
            $invoice = Invoice::findOrFail($invoice_id);
            //ইনভয়েসের ভ্যালিডেশন চেক হচ্ছে যে ইনভয়েস টি এই ব্রাঞ্চ থেকেই তৈরি করা হয়েছে কিনা
            if ($invoice != null && $invoice->from_branch_id == auth()->user()->branch->id) {
                $invoice_counter++;
            }
        }

        if ($invoice_counter > !0) {
            return response()->json([
                'type' => 'error',
                'message' => 'Chose your invoice items.',
            ]);
        }

        foreach (explode(',', $request->invoices) as $invoice_id) {
            $invoice = Invoice::findOrFail($invoice_id);
            //ইনভয়েসের ভ্যালিডেশন চেক হচ্ছে যে ইনভয়েস টি এই ব্রাঞ্চ থেকেই তৈরি করা হয়েছে কিনা
            if ($invoice != null && $invoice->from_branch_id == auth()->user()->branch->id) {
                $invoice->delete();
            }
        }

        return response()->json([
            'type' => 'success',
            'message' => 'Successfully deleted',
        ]);
    }



    public function conditionInvoiceCreate()
    {
        $linked_branches = auth()->user()->branch->fromLinkedBranchs;
        $invoices = auth()->user()->branch->fromInvoices()->where('status', 'Received')->get();
        return view('backend.manager.invoice.create', compact('linked_branches', 'invoices'));
    }

    public function conditionInvoiceGet()
    {
        $status = 'All';
        $branch_name = 'All';
        $invoices = auth()->user()->branch->fromInvoices()->where('condition_amount', '>', '0')->orderBy('id', 'desc')->paginate(100);
        return view('backend.manager.invoice.index', compact('invoices', 'status', 'branch_name'));
    }

    public function getLastFiveInvoice()
    {
        $invoices = auth()->user()->invoices()->orderBy('id', 'desc')->take(5)->get();
        return $invoices;
    }

    public function conditionPassword()
    {
        return view('backend.manager.invoice.password');
    }

    public function conditionPasswordSet(Request $request)
    {
        $request->validate([
            'password' => 'required|string'
        ]);

        if($request->password == get_static_option('conditional_password')){
            Session::put('conditional_password', $request->password);
            return redirect()->route('manager.conditionInvoice.get');
        }else{
            return back()->withErrors('কন্ডিশন দেখার পাসওয়ার্ড টি ভুল হয়েছে।');
        }

    }
}
