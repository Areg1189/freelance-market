<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{

    private $user;
    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function index(Request $request)
    {

          $notifications = Auth::user()->notifications()->paginate(15);
          if($request->ajax()){
             $notifications = Auth::user()->unreadNotifications()->orderBy('created_at','DESC')->limit(5)->get();
              $view = view('notifications.notify-list', compact('notifications'))->render();
              return response()->json(['view' => $view]);
          }

        return view('notifications.notifications', compact('notifications'));
    }

    public function markAsRead(Request $request)
    {
        if($request->notif_id){
            Auth::user()->notifications()->find($request->notif_id)->markAsRead();
            return response()->json(['success' => true]);
        }
        auth()->user()->unreadNotifications->markAsRead();
    }
}
