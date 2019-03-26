<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupportRequest;
use App\Mail\MailToSupport;
use App\Models\Support;
use App\Models\UserMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Pusher\Pusher;
class SupportController extends Controller
{


    public function index()
    {
        $supports = new Support();

        $supports = $supports->get();
        $count = $supports->count();

        return view('support.index',compact('supports','count'));

    }

    public function showDescription(Request $request)
    {
        $support = Support::where('id',$request->id)->first();

        return view('support.partials.support-description',compact('support'))->render();
    }

    public function showResult(Request $request)
    {
        $support = Support::where('id',$request->id)->first();
$view = view('support.partials.support-item', compact('support'))->render();
        return  response()->json(['html' => $view]);
    }
    public function showContacts()
    {
        $supports = new Support();

        $supports = $supports->get();
        $count = $supports->count();

     return view('support.contact',compact('supports','count'));

    }

    public function send(SupportRequest $request)
    {
        try{
            DB::beginTransaction();
            $suppotredInfo = UserMessage::create($request->all());
            $email =config('app.support_email');
            $senderName = $request->user_name;
            $senderEmail = $request->email;
            $senderPhone = $request->phone;
            $senderMessage = $request->message;
            $pusher = new Pusher(
                config('messenger.pusher.app_key'),
                config('messenger.pusher.app_secret'),
                config('messenger.pusher.app_id'),
                [
                    'cluster' => config('messenger.pusher.options.cluster')
                ]
            );
            $pusher->trigger('admin-chanel', 'admin-event', [
                'type' => 'support-job',
                'author' => $senderEmail,
            ]);

        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return redirect()->back()->with(['msg' => 'danger']);
        }

        if (setting('site.send_email_admin_support') == 1){
        try {
            Mail::to($email)->send(new MailToSupport($senderName, $senderEmail, $senderPhone, $senderMessage));
            DB::commit();
            toastr()->success('Your Message Send Successfully');
            return redirect()->back()->with(['msg' => 'success']);
        }
        catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return redirect()->back()->with(['msg' => 'danger']);
        }
        }else{
            try{
                DB::commit();
                toastr()->success('Your Message Send Successfully');
                return redirect()->back()->with(['msg' => 'success']);
            }catch (\Exception $e){
                DB::rollback();
                return redirect()->back()->with(['msg' => 'danger']);
            }

        }
    }

    public function showHistory(Request $request)
    {
        $supportId = $request->id;
        $support = Support::find($supportId);

        $userId = auth()->user()->id;

        $support->supportLikes()->attach($userId);

        return 'OK';
    }

}
