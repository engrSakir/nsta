<?php

namespace App\Http\Controllers\Backend\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Jobs\EmailSenderJob;
use App\Jobs\SingleEmailSenderJob;
use Illuminate\Http\Request;
use App\Models\WebsiteSubscribe;
use Illuminate\Support\Facades\Artisan;
use Yajra\DataTables\Facades\DataTables;


class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = WebsiteSubscribe::all();
            return datatables::of($data)
               ->addColumn('email', function ($data) {
                    return '<a href="mailto:'.$data->email.'">'.$data->email.'</a>';
                })
                ->addColumn('action', function ($data) {
                    return '<button class="text-white btn btn-danger " onclick="delete_function(this)" value="'. route('superadmin.subscriber.destroy', $data).'">Delete</button>';
                })
                ->rawColumns(['email','action'])
                ->make(true);
        } else {
            return view('backend.superadmin.website.subscriber.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(WebsiteSubscribe $subscriber)
    {
        try {
            $subscriber->delete();
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

    public function subscriberUpdate(Request $request){
        $request->validate([
            'title' => 'required|string',
            'description' => 'required',
        ]);
        try {
            update_static_option('subscriber_title', $request->title);
            update_static_option('subscriber_description', $request->description);

            return back()->withToastSuccess('Successfully updated.');
        }catch (\Exception $exception){
            return back()->withErrors('Something going wrong. '.$exception->getMessage());
        }
    }

    public function subscriberEmail(){
        $subscriber = WebsiteSubscribe::all()->count();
        return view('backend.superadmin.website.subscriber.email', compact('subscriber'));
    }

    public function subscriberEmailSend(Request $request){
        $request->validate([
            'subject' => 'required|string',
            'description' => 'required',
        ]);
        $emails = WebsiteSubscribe::all()->pluck('email');
        //Send  to job
        //dd($emails);
        try {
            dispatch(new EmailSenderJob($emails, $request->description))->delay(now()->addSeconds(5));
            //Run queue for one time
            Artisan::call('queue:work --once');

            return back()->withToastSuccess('Successfully email sent.');
        }catch (\Exception $exception){
            return back()->withErrors('Something going wrong. '.$exception->getMessage());
        }
    }
}
