<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (auth()->user()->is_suspended == 1) {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Your account is temporarily suspended');
            }

            if (auth()->user()->type != 'User') {
                Auth::logout();
                return redirect()->route('login')->with('error', 'You are not a User');
            }

            return $next($request);
        } else {
            return redirect()->route('login')->with('error', 'You are not logged in');
        }
    }
}
