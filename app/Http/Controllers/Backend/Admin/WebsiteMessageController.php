<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\EmailSenderJob;
use App\Models\WebsiteMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Yajra\DataTables\Facades\DataTables;
class WebsiteMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = WebsiteMessage::all();
            return datatables::of($data)
               ->addColumn('email', function ($data) {
                    return '<a href="mailto:'.$data->email.'">'.$data->email.'</a>';
                })
                ->addColumn('status', function ($data) {
                    if($data->is_process_complete == 0){
                        $html = '<button type="button" class="btn btn-block btn-lg btn-warning mt-2" value="'.$data->id.'" onclick="changeStatus(\''.$data->id.'\',\''.$data->is_process_complete.'\')" >Inprocess</button>';
                    }elseif($data->is_process_complete == 1){
                        $html = '<button type="button" class="btn btn-block btn-lg btn-success mt-2" value="'.$data->id.'" onclick="changeStatus(\''.$data->id.'\',\''.$data->is_process_complete.'\')" >Completed</button>';
                    }
                         return $html;
                    })
               ->addColumn('phone', function ($data) {
                    return '<a href="tel:'.$data->phone.'">'.$data->phone.'</a>';
                })
                ->addColumn('action', function ($data) {
                    return '<div class="row"></div><a href="'.route('admin.websiteMessage.show', $data).'" class="text-white btn btn-info col mb-1">Show</a>
                    <button class="text-white btn btn-danger col" onclick="delete_function(this)" value="'. route('admin.websiteMessage.destroy', $data).'">Delete</button></div>';
                })
                ->rawColumns(['email','status','phone','action'])
                ->make(true);
        } else {
            return view('backend.admin.website.message.index');
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
    public function show(WebsiteMessage $websiteMessage)
    {
        return view('backend.admin.website.message.show', compact('websiteMessage'));
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
    public function destroy(WebsiteMessage $websiteMessage)
    {
        try {
            $websiteMessage->delete();
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

    // message  Status Change
    public function messageStatusChange(Request $request){
        $request->validate([
            'messege'=> 'required|exists:website_messages,id',
            'status'=> 'required',
        ]);
        $message = WebsiteMessage::find($request->input('messege'));
        $message->is_process_complete = $request->input('status');

        try {
            $message->save();
            return response()->json([
                'type' => 'success',
                'message' => 'Successfully status changed.',
            ]);
        }catch (\Exception $exception){
            return response()->json([
                'type' => 'danger',
                'message' => 'Error !!! '.$exception->getMessage(),
            ]);
        }
    }

    public function websiteMessageReplyMail(Request $request){
        $request->validate([
            'email'=> 'required|email',
            'description'=> 'required|string',
        ]);
//        dd(explode(',', $request->email));
        //Send  to job
        dispatch(new EmailSenderJob(explode(',', $request->email), $request->description))->delay(now()->addSeconds(5));
        //Run queue for one time
        Artisan::call('queue:work --once');
        return back()->withToastSuccess('Successfully mail sent to '.$request->email);
    }

    public function messageUpdate(Request $request){
        $request->validate([
            'title' => 'required|string',
            'description' => 'required',
        ]);
        try {
            update_static_option('message_title', $request->title);
            update_static_option('message_description', $request->description);

            return back()->withToastSuccess('Successfully updated.');
        }catch (\Exception $exception){
            return back()->withErrors('Something going wrong. '.$exception->getMessage());
        }
    }
}
