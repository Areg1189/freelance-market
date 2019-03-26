<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Sarfraznawaz2005\VisitLog\Facades\VisitLog;

class FirstWorkMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//Session::forget('open_advertising');
        if (!$request->user() || $request->user()->role->name != 'admin') VisitLog:: save();
        if (Session::get('open_advertising')){
//            $request->request->add(['open_advertising' => null]);
            $request->request->remove('open_advertising');

        }else{
            $request->request->add(['open_advertising' => DB::table('advertising_notices')->where('status', 'published')->first()]);
            Session::put('open_advertising', true);
        }



        return $next($request);
    }
}
