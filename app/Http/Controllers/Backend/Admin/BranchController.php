<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\BranchLink;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = auth()->user()->company->branches;
        $year = date('Y');
        return view('backend.admin.branch.index', compact('branches','year'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = auth()->user()->company->branches;
        return view('backend.admin.branch.create', compact('branches'));
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
            'name' => 'required|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'sender_search_length' => 'required|numeric|min:0',
            'receiver_search_length' => 'required|numeric|min:0',
            'global_search_length' => 'required|numeric|min:0',
            'custom_inv_counter_max_value' => 'required|numeric|min:0',
            'custom_inv_counter_min_value' => 'required|numeric|min:0',
            'status' => 'required|boolean',
            'head_office' => 'required|boolean',
            'linked_branches' => 'nullable|exists:branches,id',
        ]);

        $branch = new Branch();
        $branch->company_id = auth()->user()->company->id;
        $branch->name = $request->name;
        $branch->email = $request->email;
        $branch->phone = $request->phone;
        $branch->address = $request->address;
        $branch->sender_search_length = $request->sender_search_length;
        $branch->receiver_search_length = $request->receiver_search_length;
        $branch->global_search_length = $request->global_search_length;
        $branch->custom_inv_counter_max_value = $request->custom_inv_counter_max_value;
        $branch->custom_inv_counter_min_value = $request->custom_inv_counter_min_value;
        $branch->is_active = $request->status;
        $branch->is_head_office = $request->head_office;
        try {
            $branch->save();
            if (BranchLink::where('from_branch_id', $branch->id)->count() > 0){
                BranchLink::where('from_branch_id', $branch->id)->delete();
            }
            if ($request->linked_branches){
                foreach ($request->linked_branches as $linked_branch){
                    if (auth()->user()->company->id != Branch::find($linked_branch)->company->id){
                        return back()->withErrors('You have not access');
                    }
                    $branch_link = new BranchLink();
                    $branch_link->from_branch_id    =   $branch->id;
                    $branch_link->to_branch_id  =   $linked_branch;
                    $branch_link->save();
                }
            }
            return redirect()->route('admin.branch.index')->withSuccess('Branch successfully added');
        } catch (\Exception $exception) {
            return back()->withErrors( $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branch)
    {
        if ($branch->company->id != auth()->user()->company->id){
            return back()->withErrors('You have not access');
        }

        $branches = auth()->user()->company->branches;
        return view('backend.admin.branch.edit', compact('branch', 'branches'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Branch $branch)
    {
        if ($branch->company->id != auth()->user()->company->id){
            return back()->withErrors('You have not access');
        }

        $request->validate([
            'name' => 'required|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'sender_search_length' => 'required|numeric|min:0',
            'receiver_search_length' => 'required|numeric|min:0',
            'global_search_length' => 'required|numeric|min:0',
            'custom_inv_counter_max_value' => 'required|numeric|min:0',
            'custom_inv_counter_min_value' => 'required|numeric|min:0',
            'custom_chalan_counter_max_value' => 'required|numeric|min:0',
            'custom_chalan_counter_min_value' => 'required|numeric|min:0',
            'status' => 'required|boolean',
            'head_office' => 'required|boolean',
            'linked_branches' => 'nullable|exists:branches,id',
            'invoice_heading_one' => 'nullable|string',
            'invoice_heading_two' => 'nullable|string',
            'chalan_heading_one' => 'nullable|string',
            'chalan_heading_two' => 'nullable|string',
            'chalan_heading_three' => 'nullable|string',
            'invoice_watermark' => 'nullable|image',
        ]);

        $branch->name = $request->name;
        $branch->email = $request->email;
        $branch->phone = $request->phone;
        $branch->address = $request->address;

        $branch->sender_search_length = $request->sender_search_length;
        $branch->receiver_search_length = $request->receiver_search_length;
        $branch->global_search_length = $request->global_search_length;

        $branch->custom_inv_counter_max_value = $request->custom_inv_counter_max_value;
        $branch->custom_inv_counter_min_value = $request->custom_inv_counter_min_value;

        $branch->custom_chalan_counter_max_value = $request->custom_chalan_counter_max_value;
        $branch->custom_chalan_counter_min_value = $request->custom_chalan_counter_min_value;

        $branch->invoice_heading_one = $request->invoice_heading_one;
        $branch->invoice_heading_two = $request->invoice_heading_two;

        $branch->chalan_heading_one = $request->chalan_heading_one;
        $branch->chalan_heading_two = $request->chalan_heading_two;
        $branch->chalan_heading_three = $request->chalan_heading_three;

        $branch->is_active = $request->status;
        $branch->is_head_office = $request->head_office;

        if($request->hasFile('invoice_due_watermark')){
            if ($branch->invoice_due_watermark != null)
                File::delete(public_path($branch->invoice_due_watermark)); //Old image delete
            $image             = $request->file('invoice_due_watermark');
            $folder_path       = 'uploads/images/branch/watermark/';
            if (!file_exists($folder_path)) {
                mkdir($folder_path, 0777, true);
            }
            $image_new_name    = Str::random(20).'-'.now()->timestamp.'.'.$image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->save($folder_path.$image_new_name);
            $branch->invoice_due_watermark = $folder_path.$image_new_name;
        }

        if($request->hasFile('invoice_paid_watermark')){
            if ($branch->invoice_paid_watermark != null)
                File::delete(public_path($branch->invoice_paid_watermark)); //Old image delete
            $image             = $request->file('invoice_paid_watermark');
            $folder_path       = 'uploads/images/branch/watermark/';
            if (!file_exists($folder_path)) {
                mkdir($folder_path, 0777, true);
            }
            $image_new_name    = Str::random(20).'-'.now()->timestamp.'.'.$image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->save($folder_path.$image_new_name);
            $branch->invoice_paid_watermark = $folder_path.$image_new_name;
        }

        try {
            $branch->save();

            if (BranchLink::where('from_branch_id', $branch->id)->count() > 0){
                BranchLink::where('from_branch_id', $branch->id)->delete();
            }
            if ($request->linked_branches) {
                foreach ($request->linked_branches as $linked_branch) {
                    if (auth()->user()->company->id != Branch::find($linked_branch)->company->id) {
                        return back()->withErrors('You have not access');
                    }
                    $branch_link = new BranchLink();
                    $branch_link->from_branch_id = $branch->id;
                    $branch_link->to_branch_id = $linked_branch;
                    $branch_link->save();
                }
            }
            return back()->withSuccess('Branch successfully updated');
        } catch (\Exception $exception) {
            return back()->withErrors( $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
        //
    }
}
