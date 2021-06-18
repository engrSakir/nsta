<?php

namespace App\Http\Controllers\Backend\Manager;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class AdvanceSearchController extends Controller
{
    public function index(){
        $invoices = null;
//        dd(auth()->user()->branch->fromLinkedBranchs) ;
        return view('backend.manager.advance-search.index', compact('invoices'));
    }

    public function search(Request $request){

        $data  = Invoice::where( function($query) use($request){
                return $request->filter_brand ?
                $query->from('invoices')->where('brand_id',$request->filter_brand) : '';
            })
            ->where(function($query) use($request){
                return $request->year_of_manufacture ?
                    $query->from('invoices')->where('year_of_manufacture',$request->year_of_manufacture) : '';
            })
            ->where(function($query) use($request){
                return $request->owner_s_name_and_surname ?
                    $query->from('invoices')->where('owner_s_name_and_surname',$request->owner_s_name_and_surname) : '';
            })
            ->where(function($query) use($request){
                return $request->number_of_owners ?
                    $query->from('invoices')->where('number_of_owners',$request->number_of_owners) : '';
            })
            ->where(function($query) use($request){
                return $request->comments ?
                    $query->from('invoices')->where('comments',$request->comments) : '';
            })
            ->get();

        $invoices = $data;
        return view('backend.manager.advance-search.index', compact('invoices'));
    }
}
