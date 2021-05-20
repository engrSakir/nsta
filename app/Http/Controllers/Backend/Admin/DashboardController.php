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

        $permitted_branch_amount  = auth()->user()
            ->company->purchasePackage->package->branch;

        //2
        $used_admin_amount  = auth()->user()
            ->company->admins->count();

        $permitted_admin_amount  = auth()->user()
            ->company->purchasePackage->package->admin;

        //3
        $used_manager_amount  = auth()->user()
            ->company->managers->count();

        $permitted_manager_amount  = auth()->user()
            ->company->purchasePackage->package->manager;

        //4
        $used_customer_amount  = CustomerAndBranch::whereIn('branch_id', auth()->user()->company->branches->pluck('id'))
            ->count();

        $permitted_customer_amount  = auth()->user()
            ->company->purchasePackage->package->customer;

        //5
        $used_invoice_amount  = CustomerAndBranch::whereIn('branch_id', auth()->user()->company->branches->pluck('id'))
            ->count();

        $permitted_invoice_amount  = auth()->user()
            ->company->purchasePackage->package->invoice;

        //usable_message_amount = Total purchased message - Total used message
        $usable_message_amount  = auth()->user()
                ->company->purchaseMessages->sum('message_amount')
            - auth()->user()->company->messageHistories->sum('message_count');


        $data = array (
            "used_branch_amount"  => $used_branch_amount,
            "permitted_branch_amount"  =>$permitted_branch_amount,
            "used_admin_amount"  => $used_admin_amount,
            "permitted_admin_amount"  => $permitted_admin_amount,
            "used_manager_amount" => $used_manager_amount,
            "permitted_manager_amount" => $permitted_manager_amount,
            "used_customer_amount"   => $used_customer_amount,
            "permitted_customer_amount"   => $permitted_customer_amount,
            "used_invoice_amount"   => $used_invoice_amount,
            "permitted_invoice_amount"   => $permitted_invoice_amount,
            "usable_message_amount"   => $usable_message_amount,
        );

        return view('backend.admin.dashboard.index', compact('data'));
    }
}
