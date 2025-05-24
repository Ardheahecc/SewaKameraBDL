<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticatePelanggan
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('pelanggan')->check()) {
            return redirect()->route('/')->withErrors('Silakan login terlebih dahulu sebagai pelanggan.');
        }
        return $next($request);
    }
}
