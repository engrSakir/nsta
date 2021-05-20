<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use App\Models\PortfolioImage;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            $data = Portfolio::all();
            return datatables::of($data)
                ->addColumn('image', function($data) {
                    $html ="";
                    foreach($data->images as $image){
                        $html .='<img class="rounded-circle" height="70px;" width="70px;" src="'.$image->image.'" /><br>';
                    }
                    return $html;
                })->addColumn('status', function($data) {
                    if($data->is_active == true){
                        return '<span class="badge badge-pill badge-success">Active</span>';
                    }else{
                        return '<span class="badge badge-pill badge-danger">Inactive</span>';
                    }
                })->addColumn('action', function($data) {
                    return '<a href="'.route('admin.portfolio.edit', $data).'" class="btn btn-info"><i class="fas fa-edit"></i> </a>
                   <button class="btn btn-danger" onclick="delete_function(this)" value="'.route('admin.portfolio.destroy', $data).'"><i class="fas fa-trash"></i> </button>';
                })
                ->rawColumns(['image','status', 'action'])
                ->make(true);
        }else{
            return view('backend.admin.website.portfolio.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $portfolioCategories = PortfolioCategory::all();
        return view('backend.admin.website.portfolio.create', compact('portfolioCategories'));
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
            'short_title' => 'required|string',
            'long_title' => 'required|string',
            'short_description' => 'required|string',
            'long_description' => 'required|string',
            'status' => 'required',
            'category' => 'required|exists:portfolio_categories,id',
            'image' => 'nullable|image',
        ]);

        $portfolio = new Portfolio();

        $portfolio->short_title    =   $request->short_title ;
        $portfolio->long_title    =   $request->long_title ;
        $portfolio->is_active    =  $request->status;
        $portfolio->short_description    =  $request->short_description;
        $portfolio->long_description    =  $request->long_description;
        $portfolio->category_id    =  $request->category;
        $portfolio->slug    =  Str::slug($request->short_title, '-');
        try {
            $portfolio->save();
        }catch (\Exception $exception){
            return back()->withErrors('Something going wrong. '.$exception->getMessage());
        }
        if($request->hasFile('image')){
            $image             = $request->file('image');
            $folder_path       = 'uploads/images/portfolio/';
            if (!file_exists($folder_path)) {
                mkdir($folder_path, 0755, true);
            }
            $image_new_name    = Str::random(20).'-'.now()->timestamp.'.'.$image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->save($folder_path.$image_new_name);

            $portfolio_image = new PortfolioImage();
            $portfolio_image->portfolio_id = $portfolio->id;
            $portfolio_image->image = $folder_path . $image_new_name;
        }
        try {
            $portfolio_image->save();
            return back()->withToastSuccess('Successfully saved.');
        }catch (\Exception $exception){
            return back()->withErrors('Something going wrong. '.$exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function show(Portfolio $portfolio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function edit(Portfolio $portfolio)
    {
        $portfolioCategories = PortfolioCategory::all();
        return view('backend.admin.website.portfolio.edit', compact('portfolioCategories','portfolio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Portfolio $portfolio)
    {
        $request->validate([
            'short_title' => 'required|string',
            'long_title' => 'required|string',
            'short_description' => 'required|string',
            'long_description' => 'required|string',
            'status' => 'required',
            'category' => 'required|exists:portfolio_categories,id',
        ]);

        $portfolio->short_title    =   $request->short_title ;
        $portfolio->long_title    =   $request->long_title ;
        $portfolio->is_active    =  $request->status;
        $portfolio->short_description    =  $request->short_description;
        $portfolio->long_description    =  $request->long_description;
        $portfolio->category_id    =  $request->category;

        try {
            $portfolio->save();
            return back()->withToastSuccess('Successfully saved.');
        }catch (\Exception $exception){
            return back()->withErrors('Something going wrong. '.$exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $portfolio)
    {
        try {
            foreach($portfolio->image as $image){
                if ($image->image != null)
                    File::delete(public_path($image->image)); //Old image delete
            }
            $portfolio->delete();
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

    public function portfolio(){
        return view('backend.admin.website.portfolio.portfolio');
    }

    public function portfolioUpdate(Request $request){
        $request->validate([
            'title' => 'required|string',
            'description' => 'required',
        ]);
        try {
            update_static_option('portfolio_title', $request->title);
            update_static_option('portfolio_description', $request->description);

            return back()->withToastSuccess('Successfully updated.');
        }catch (\Exception $exception){
            return back()->withErrors('Something going wrong. '.$exception->getMessage());
        }
    }

    public function addPortfolioImages(Request $request, Portfolio $portfolio){
        $request->validate([
            'file' => 'required',
        ]);
        $portfolio_image = new PortfolioImage();

        if($request->hasFile('file')){
            $image             = $request->file('file');
            $folder_path       = 'uploads/images/portfolio/';
            if (!file_exists($folder_path)) {
                mkdir($folder_path, 0755, true);
            }
            $image_new_name    = $image->getClientOriginalName();
            //resize and save to server
            Image::make($image->getRealPath())->save($folder_path.$image_new_name);


            $portfolio_image->portfolio_id = $portfolio->id;
            $portfolio_image->image = $folder_path . $image_new_name;
        }
        try {
            $portfolio_image->save();
            return back()->withToastSuccess('Successfully saved.');
        }catch (\Exception $exception){
            return back()->withErrors('Something going wrong. '.$exception->getMessage());
        }
    }

    public function removePortfolioImages(Request $request){
        $request->validate([
            'portfolio' => 'required|exists:portfolios,id',
            'image' => 'required',
        ]);
        try {
            $image       = $request->image;
            $portfolio = PortfolioImage::where('image', $image)->where('portfolio_id', $request->portfolio)->first();
            if ($portfolio->image != null)
                File::delete(public_path($portfolio->image)); //Old image delete
            $portfolio->delete();
            return response()->json([
                'type' => 'success',
                'message' => '',
            ]);
        }catch (\Exception $exception){
            return response()->json([
                'type' => 'error',
                'message' => $exception->getMessage(),
            ]);
        }
    }

    public function getPortfolioImages(Request $request){
        $request->validate([
            'portfolio' => 'required|exists:portfolios,id',
        ]);
        return Portfolio::findOrFail($request->portfolio)->images;
    }
}
