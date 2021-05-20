<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageHistoryController extends Controller
{
    public function index(){
        $messages = auth()->user()->company->messageHistories;
        return view('backend.admin.message.index');
    }
}
