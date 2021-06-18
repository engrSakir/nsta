<?php

namespace App\Http\Controllers\Backend\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdvanceSearchController extends Controller
{
    public function index(){
        $invoices = null;
//        dd(auth()->user()->branch->fromLinkedBranchs) ;

        return view('backend.manager.advance-search.index', compact('invoices'));
    }
}
