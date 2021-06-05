<?php

namespace App\Http\Controllers\Backend\Manager;

use App\Http\Controllers\Controller;
use App\Models\Chalan;
use App\Models\Invoice;
use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf as PDF;

class ChalanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chalans = auth()->user()->branch->fromChalans()->orderBy('id', 'desc')->paginate(100);
        return view('backend.manager.chalan.index', compact('chalans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'invoices' => 'required',
            'branch_office' => 'required|exists:branches,id',
            'driver_name' => 'required|string',
            'driver_phone' => 'required|string',
            'car_number' => 'required|string',
            'chalan_note' => 'nullable|string|max:1500',
        ]);

        //# Step 0 CHECK TO_BRANCH IS VALID OR NOT
        if (!check_branch_link(auth()->user()->branch->id, $request->branch_office)){
            return response()->json([
                'type' => 'error',
                'message' => 'Branch are not linked. Contact with admin.',
            ]);
        }

        $invoice_counter = 0;
        foreach(explode(',', $request->invoices) as $invoice_id){
            $invoice = Invoice::findOrFail($invoice_id);
            //ইনভয়েসের ভ্যালিডেশন চেক হচ্ছে যে ইনভয়েস টি এই ব্রাঞ্চ থেকেই তৈরি করা হয়েছে কিনা
            if ($invoice !=null && $invoice->from_branch_id == auth()->user()->branch->id && $invoice->status == 'Received'){
                $invoice_counter++;
            }
        }

        if($invoice_counter < 1){
            return response()->json([
                'type' => 'error',
                'message' => 'দয়া করে রিসিভ হওয়া ভাউচার সমূহ পছন্দ করুন',
            ]);
        }

        $chalan = new Chalan();
        $chalan->from_branch_id =   auth()->user()->branch->id;
        $chalan->to_branch_id   =   $request->branch_office;
        $chalan->created_by     =   auth()->user()->id;
        $chalan->driver_name    =   $request->driver_name;
        $chalan->driver_phone   =   $request->driver_phone;
        $chalan->car_number     =   $request->car_number;
        $chalan->chalan_note     =   $request->chalan_note;

        //Logic for custom counter
        $custom_counter = Chalan::where('from_branch_id', auth()->user()->branch->id)->orderBy('id', 'desc')->first()->custom_counter ?? 0;
        if ($custom_counter >= auth()->user()->branch->custom_chalan_counter_max_value){
            $custom_counter = auth()->user()->branch->custom_chalan_counter_min_value;
        }else{
            $custom_counter++;
        }

        $chalan->custom_counter        = $custom_counter;

        $chalan->save();

        foreach(explode(',', $request->invoices) as $invoice_id){
            $invoice = Invoice::findOrFail($invoice_id);
            //ইনভয়েসের ভ্যালিডেশন চেক হচ্ছে যে ইনভয়েস টি এই ব্রাঞ্চ থেকেই তৈরি করা হয়েছে কিনা
            if ($invoice !=null && $invoice->from_branch_id == auth()->user()->branch->id && $invoice->status == 'Received'){
                $invoice->chalan_id = $chalan->id;
                $invoice->status = 'On Going';
                $invoice->save();
            }
        }

        $sms_body = 'নতুন চালান এসেছে ' . $chalan->fromBranch->name . ' থেকে। ড্রাইভারের মোবাইলঃ' . $chalan->driver_phone . ' গাড়ী নংঃ ' . $chalan->car_number;

        if($chalan->toBranch->phone != null && sms($chalan->toBranch->phone, $invoice->sender_name .$sms_body) == true){
            return response()->json([
                'type' => 'success',
                'message' => 'স্ট্যাটাস পরিবর্তন করা হয়েছে। এবং চালান তৈরি করে ম্যানেজার কে মেসেজ দেয়া হয়েছে।',
                'url' => route('manager.chalan.show', $chalan),
            ]);
        }else{
            return response()->json([
                'type' => 'success',
                'message' => 'স্ট্যাটাস পরিবর্তন করা হয়েছে এবং চালান তৈরি হয়েছে। কিন্তু মেসেজ পাঠাতে সমস্যা হচ্ছে।',
                'url' => route('manager.chalan.show', $chalan),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chalan  $chalan
     * @return \Illuminate\Http\Response
     */
    public function show(Chalan $chalan)
    {
        if ($chalan->from_branch_id == auth()->user()->branch->id || $chalan->to_branch_id == auth()->user()->branch->id){
//            if ($invoice->fromBranch->invoice_style == 'A5'){
            $pdf = PDF::loadView('backend.pdf.a-4-one', compact('chalan'));
//            }else if ($invoice->fromBranch->invoice_style == 'A4'){
//                $pdf = PDF::loadView('backend.pdf.a4', compact('invoice'));
//            }
            return $pdf->stream('Invoice-'.config('app.name').'-('.$chalan->fromBranch->company->name.'- chalan date-'.$chalan->created_at->format('d-m-y').').pdf');
        }else{
            return back()->withErrors('Your are not permitted to check this invoice.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chalan  $chalan
     * @return \Illuminate\Http\Response
     */
    public function edit(Chalan $chalan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chalan  $chalan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chalan $chalan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chalan  $chalan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chalan $chalan)
    {
        if ($chalan->from_branch_id == auth()->user()->branch->id || $chalan->to_branch_id == auth()->user()->branch->id){
            try {
                $chalan->delete();
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
            return back()->withErrors('Your are not permitted to check this chalan.');
        }
    }

    public function makeAsDeleted(Request $request)
    {
        $request->validate([
            'chalans' => 'required',
        ]);

        $chalans_counter = 0;
        foreach(explode(',', $request->chalans) as $chalan_id){
            $chalan = Chalan::findOrFail($chalan_id);
            //ইনভয়েসের ভ্যালিডেশন চেক হচ্ছে যে ইনভয়েস টি এই ব্রাঞ্চ থেকেই তৈরি করা হয়েছে কিনা
            if ($chalan !=null && $chalan->from_branch_id == auth()->user()->branch->id){
                $chalans_counter++;
            }
        }

        if($chalans_counter >! 0){
            return response()->json([
                'type' => 'error',
                'message' => 'Chose your chalan items.',
            ]);
        }

        foreach(explode(',', $request->chalans) as $chalan_id){
            $chalan = Chalan::findOrFail($chalan_id);
            //ইনভয়েসের ভ্যালিডেশন চেক হচ্ছে যে ইনভয়েস টি এই ব্রাঞ্চ থেকেই তৈরি করা হয়েছে কিনা
            if ($chalan !=null && $chalan->from_branch_id == auth()->user()->branch->id){
                $chalan->delete();
            }
        }

        return response()->json([
            'type' => 'success',
            'message' => 'Successfully deleted',
        ]);
    }
}
