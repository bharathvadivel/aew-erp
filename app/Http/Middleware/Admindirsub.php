<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admindirsub
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

if ($login=='admin' || $login=='direct_dealer' || $login=='sub_dealer') {
    return $next($request);
} else {
    return redirect()->back();
}

    }
}
