<?php

namespace App\Http\Controllers\Backend\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $invoices = auth()->user()->branch->fromInvoices()->orderBy('id', 'desc')->get();
        $year = date('Y');
        return view('backend.manager.dashboard.index', compact('invoices', 'year'));
    }
}
