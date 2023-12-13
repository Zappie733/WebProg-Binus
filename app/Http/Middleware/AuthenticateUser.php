<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateUser
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('loginPage');
        }

        if ($request->is('users') && !Auth::user()->isAdmin) {
            return redirect()->route('home');
        }
        
        return $next($request);

    }
}
