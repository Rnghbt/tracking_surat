<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class guest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd($request->session()->get('api_token')['token']);
        // if ($request->session()->has('api_token')) {
        //     $token = $request->session()->get('api_token');
        //     // Atau gunakan cara lain untuk mengambil token dari session yang sesuai dengan struktur Anda

        //     if ($token)
        //         dd($token);
        //     // return redirect()->route('login');
        // }
        if (1 === 1) {
            return $next($request);
        }
    }
}
