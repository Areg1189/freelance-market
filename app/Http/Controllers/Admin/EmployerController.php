<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Voyager\VoyagerBaseController;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployerController extends VoyagerBaseController
{
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'email' => 'required|email|unique:users,email'
        ]);

        if ($validate->fails()){
            return response()->json(['errors' => $validate->messages()]);
        }

        if (!$request->ajax()){
            $user = new User();
            $user->name = $request->first_name.' '.$request->last_name;
            $user->email = $request->email;
            $user->email_verified_at = Carbon::now()->toDateTimeString();
            $user->role_id = 4;
            $user->password = bcrypt(config('app.user_default_password'));
            $slug = str_slug($request->first_name.' '.$request->last_name);

            if (User::where('slug', $slug)->first()){
                while(true){
                    $slug = $slug.'-'.str_random(3);
                    if (!User::where('slug', $slug)->first()){
                        break;
                    }
                }
            }

            $user->slug = $slug;

            $user->save();
            $request['user_id'] = $user->id;
        }

        return parent::store($request); // TODO: Change the autogenerated stub
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(),[
            'email' => 'required|email|unique:users,email,'.$request->user_id
        ]);

        if ($validate->fails()){
            return response()->json(['errors' => $validate->messages()]);
        }
        if (!$request->ajax()){
            $user = User::find($request->user_id);
            $user->name = $request->first_name.' '.$request->last_name;
            $user->email = $request->email;
            $user->save();
        }
        return parent::update($request, $id); // TODO: Change the autogenerated stub

    }
}
