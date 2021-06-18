<?php

namespace App\Http\Controllers\Backend\Manager;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdvanceSearchController extends Controller
{
    public function index(){
        $invoices = null;
//        dd(auth()->user()->branch->fromLinkedBranchs) ;
        return view('backend.manager.advance-search.index', compact('invoices'));
    }

    public function search(Request $request){
        $request->validate([
            'starting_date' => 'required_with_all:ending_date',
            'ending_date' => 'required_with_all:starting_date',
            'prerok_name' => 'nullable|string',
            'prerok_phone' => 'nullable|string',
            'prapok_name' => 'nullable|string',
            'prapok_phone' => 'nullable|string',
            'invoice_number' => 'nullable|string',
            'branch_office' => 'nullable|string',
        ]);

        $invoices  = Invoice::where('from_branch_id', auth()->user()->branch->id)
            ->join('users', 'invoices.receiver_id', '=', 'users.id')
            ->where(function($query) use($request){
                return $request->prapok_name ?
                $query->from('users')->where('name', 'LIKE', '%'.$request->prapok_name. '%') : '';
            })
            ->where(function($query) use($request){
                return $request->prapok_phone ?
                    $query->from('users')->where('phone', 'LIKE', '%'.$request->prapok_phone. '%') : '';
            })
            ->where( function($query) use($request){
                return $request->starting_date ?
                $query->from('invoices')->whereDate('invoices.created_at', '>=', Carbon::parse($request->starting_date)->format('Y-m-d')) : '';
            })
            ->where(function($query) use($request){
                return $request->ending_date ?
                    $query->from('invoices')->whereDate('invoices.created_at', '<=', Carbon::parse($request->ending_date)->format('Y-m-d')) : '';
            })
            ->where( function($query) use($request){
                return $request->prerok_name ?
                $query->from('invoices')->where('sender_name', 'LIKE', '%'.$request->prerok_name. '%') : '';
            })
            ->where(function($query) use($request){
                return $request->prerok_phone ?
                    $query->from('invoices')->where('sender_phone', 'LIKE', '%'.$request->prerok_phone. '%') : '';
            })
            ->where(function($query) use($request){
                return $request->invoice_number ?
                    $query->from('invoices')->where('custom_counter', 'LIKE', '%'.$request->invoice_number. '%') : '';
            })
            ->where(function($query) use($request){
                return $request->branch_office ?
                    $query->from('invoices')->where('to_branch_id', 'LIKE', '%'.$request->branch_office. '%') : '';
            })
            ->select('invoices.*')
            ->paginate(100);

//        dd($invoices);
//        dd($invoices->pluck('from_branch_id'));

        $status = 'All';
        $branch_name = 'All';
        return view('backend.manager.invoice.index', compact('invoices', 'status', 'branch_name'));

    }
}
