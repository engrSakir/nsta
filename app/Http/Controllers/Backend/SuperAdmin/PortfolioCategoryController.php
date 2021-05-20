<?php

namespace App\Http\Controllers\Backend\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\PortfolioCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;

class PortfolioCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         if ($request->ajax()){
            $data = PortfolioCategory::orderBy('id', 'desc')->get();
            return datatables::of($data)
                ->addColumn('portfolios', function($data) {
                    $html = "";
                    foreach($data->portfolios as $portfolio){
                        if($portfolio)
                            $html .=  '<span class="badge badge-pill badge-success">'.$portfolio->short_title.'</span>';
                    }
                    return $html;
                })
                ->addColumn('action', function($data) {
                    return '<a href="'.route('superadmin.portfolioCategory.edit', $data).'" class="btn btn-info"><i class="fa fa-edit"></i> </a>
                    <button class="btn btn-danger" onclick="delete_function(this)" value="'.route('superadmin.portfolioCategory.destroy', $data).'"><i class="fa fa-trash"></i> </button>';
                })
                ->rawColumns(['portfolios','action'])
                ->make(true);
        }else{
            return view('backend.superadmin.website.portfolio.category-index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('backend.superadmin.website.portfolio.category-create');
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
            'name' => 'required|string|unique:portfolio_categories'
        ]);

        $category = new PortfolioCategory();
        $category->name = $request->name;
        try {
            $category->save();
            return back()->withToastSuccess('Successfully saved.');
        }catch (\Exception $exception){
            return back()->withErrors('Something going wrong. '.$exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PortfolioCategory  $portfolioCategory
     * @return \Illuminate\Http\Response
     */
    public function show(PortfolioCategory $portfolioCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PortfolioCategory  $portfolioCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(PortfolioCategory $portfolioCategory)
    {
        return view('backend.superadmin.website.portfolio.category-edit', compact('portfolioCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PortfolioCategory  $portfolioCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PortfolioCategory $portfolioCategory)
    {
        $request->validate([
            'name' => 'required|string|unique:portfolio_categories,name,'.$portfolioCategory->id,
        ]);

        $category = $portfolioCategory;
        $category->name = $request->name;
        try {
            $category->save();
            return back()->withToastSuccess('Successfully updated !.');
        }catch (\Exception $exception){
            return back()->withErrors('Something going wrong. '.$exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PortfolioCategory  $portfolioCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(PortfolioCategory $portfolioCategory)
    {
        try {
            $portfolioCategory->delete();
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
}
