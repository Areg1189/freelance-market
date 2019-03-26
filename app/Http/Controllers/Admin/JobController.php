<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Voyager\VoyagerBaseController;
use Illuminate\Http\Request;

class JobController extends VoyagerBaseController
{
    public function index(Request $request)
    {
        auth()->user()->unreadNotifications->where('type', 'App\Notifications\JobCreate')->markAsRead();
        return parent::index($request); // TODO: Change the autogenerated stub
    }
}