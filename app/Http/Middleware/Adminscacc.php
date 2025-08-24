<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Adminscacc
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

$login=session()->get('partner_type');

if ($login=='admin' || $login=='service_center' || $login=='Accounts' || $login=='service_admin') {
    return $next($request);
} else {
    return redirect()->back();
}

    }
}
