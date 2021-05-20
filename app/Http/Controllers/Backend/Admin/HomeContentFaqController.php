<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeContent;
use App\Models\HomeContentFaq;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Yajra\DataTables\Facades\DataTables;

class HomeContentFaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            $data = HomeContentFaq::orderBy('id', 'desc')->get();
            return datatables::of($data)
                ->addColumn('homeContent', function($data) {
                        return $data->homeContent->title;
                })->addColumn('action', function($data) {
                    return '<a href="'.route('admin.homeContentFaq.edit', $data).'" class="btn btn-info"><i class="fa fa-edit"></i> </a>
                    <button class="btn btn-danger" onclick="delete_function(this)" value="'.route('admin.homeContentFaq.destroy', $data).'"><i class="fa fa-trash"></i> </button>';
                })
                ->rawColumns(['homeContent','action'])
                ->make(true);
        }else{
            return view('backend.admin.website.home-content-q-a.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $home_contents = HomeContent::all();
        return view('backend.admin.website.home-content-q-a.create', compact('home_contents'));
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
            'home_content' => 'required|exists:home_contents,id',
            'question' => 'required|string',
            'answer' => 'required',
        ]);
        $homeContentFaq = new HomeContentFaq();

        $homeContentFaq->home_content_id    =   $request->home_content;
        $homeContentFaq->question    =  $request->question;
        $homeContentFaq->answer    =  $request->answer;
        try {
            $homeContentFaq->save();
            return back()->withToastSuccess('Successfully saved.');
        }catch (\Exception $exception){
            return back()->withErrors('Something going wrong. '.$exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HomeContentFaq  $homeContentFaq
     * @return \Illuminate\Http\Response
     */
    public function show(HomeContentFaq $homeContentFaq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HomeContentFaq  $homeContentFaq
     * @return \Illuminate\Http\Response
     */
    public function edit(HomeContentFaq $homeContentFaq)
    {
        $home_contents = HomeContent::all();
        return view('backend.admin.website.home-content-q-a.edit', compact('homeContentFaq', 'home_contents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HomeContentFaq  $homeContentFaq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HomeContentFaq $homeContentFaq)
    {
        $request->validate([
            'home_content' => 'required|exists:home_contents,id',
            'question' => 'required|string',
            'answer' => 'required',
        ]);

        $homeContentFaq->home_content_id    =   $request->home_content;
        $homeContentFaq->question    =  $request->question;
        $homeContentFaq->answer    =  $request->answer;
        try {
            $homeContentFaq->save();
            return back()->withToastSuccess('Successfully updated.'. $request->home_content);
        }catch (\Exception $exception){
            return back()->withErrors('Something going wrong. '.$exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HomeContentFaq  $homeContentFaq
     * @return \Illuminate\Http\Response
     */
    public function destroy(HomeContentFaq $homeContentFaq)
    {
        //
    }
}
