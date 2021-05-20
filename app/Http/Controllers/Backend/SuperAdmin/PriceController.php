<?php

namespace App\Http\Controllers\Backend\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            $data = Price::all();
            return datatables::of($data)
                ->addColumn('action', function($data) {
                    return '<a href="'.route('superadmin.price.edit', $data).'" class="btn btn-info"><i class="fas fa-edit"></i> </a>
                   <button class="btn btn-danger" onclick="delete_function(this)" value="'.route('superadmin.price.destroy', $data).'"><i class="fas fa-trash"></i> </button>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }else{
            return view('backend.superadmin.website.price.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.superadmin.website.price.create');
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
            'name' => 'required|unique:prices,name',
            'price' => 'required|string',
            'duration' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|boolean'
        ]);
        $price     =   new Price();
        $price->name    =   $request->name;
        $price->price    =  $request->price;
        $price->duration    =  $request->duration;
        $price->description    =  $request->description;
        $price->is_active    =  $request->status;
        $price->slug    = Str::slug($request->name, '-');
        try {
            $price->save();
            return back()->withToastSuccess('Successfully saved.');
        }catch (\Exception $exception){
            return back()->withErrors('Something going wrong. '.$exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function show(Price $price)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function edit(Price $price)
    {
        return view('backend.superadmin.website.price.edit', compact('price'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Price $price)
    {
        $request->validate([
            'name' => 'required|unique:prices,name,'.$price->id,
            'price' => 'required|string',
            'duration' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|boolean'
        ]);
        $price->name    =   $request->name;
        $price->price    =  $request->price;
        $price->duration    =  $request->duration;
        $price->description    =  $request->description;
        $price->is_active    =  $request->status;
        $price->slug    = Str::slug($request->name, '-');
        try {
            $price->save();
            return back()->withToastSuccess('Successfully updated.');
        }catch (\Exception $exception){
            return back()->withErrors('Something going wrong. '.$exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function destroy(Price $price)
    {
        try {
            $price->delete();
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
    }

    public function price(){
        return view('backend.superadmin.website.price.price');
    }

    public function priceUpdate(Request $request){
        $request->validate([
            'title' => 'required|string',
            'description' => 'required',
        ]);
        try {
            update_static_option('price_title', $request->title);
            update_static_option('price_description', $request->description);

            return back()->withToastSuccess('Successfully updated.');
        }catch (\Exception $exception){
            return back()->withErrors('Something going wrong. '.$exception->getMessage());
        }
    }
}
