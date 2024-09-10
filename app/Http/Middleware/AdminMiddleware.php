<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            return $next($request);
        }
        return redirect()->route('login')->with('error', 'You are not an Admin');
    }
}




//         if (Auth::check()) {
//             if (Auth::user()->type == 'Admin') {
//                 return $next($request);
//             } else {
//                 Auth::logout();
//                 return redirect()->route('login')->with('error', 'You are not an Admin');
//             }
//         } else {
//             return redirect()->route('login')->with('error', 'You are not logged in');
//         }
//     }
// }
