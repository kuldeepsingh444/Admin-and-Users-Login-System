<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class User
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role == 'user') {
            return $next($request);
        }
        return redirect()->route('login');
    }
}
