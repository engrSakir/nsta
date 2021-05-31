<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerAndBranch;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        //1
        $used_branch_amount  = auth()->user()
            ->company->branches->count();


        //2
        $used_admin_amount  = auth()->user()
            ->company->admins->count();

        //3
        $used_manager_amount  = auth()->user()
            ->company->managers->count();

        //4
        $used_customer_amount  = CustomerAndBranch::whereIn('branch_id', auth()->user()->company->branches->pluck('id'))
            ->count();

        //5
        $used_invoice_amount  = CustomerAndBranch::whereIn('branch_id', auth()->user()->company->branches->pluck('id'))
            ->count();

        $data = array (
            "used_branch_amount"  => $used_branch_amount,
            "used_admin_amount"  => $used_admin_amount,
            "used_manager_amount" => $used_manager_amount,
            "used_customer_amount"   => $used_customer_amount,
            "used_invoice_amount"   => $used_invoice_amount,
        );

        return view('backend.admin.dashboard.index', compact('data'));
    }
}
