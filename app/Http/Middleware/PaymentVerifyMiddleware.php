<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class PaymentVerifyMiddleware
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
//        if (Auth::check() && Auth::user()->hasPermission('add_jobs') && Auth::user()->role->name != 'admin' && Auth::user()->employer && !Auth::user()->employer->getPayerEmail() && $request->url() != route('profile.edit') ) {
//            toastr()->info('Please activate your payment method <a href="' . route('profile.edit') . '">here</a>', 'Payment Verify Info',
//                [
//                    'positionClass'     => "toast-top-right"
//                ]
//            );
//        }

        return $next($request);
    }
}
