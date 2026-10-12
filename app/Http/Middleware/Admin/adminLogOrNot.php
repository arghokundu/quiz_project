<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class adminLogOrNot
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check whether admin is logged in
        if (!$request->session()->has('adminId')) 
        {
            return redirect('/login')->with('error', 'Please login first');
        }

        // Process the request only once
        $response = $next($request);

        // Prevent browser caching of protected pages
        $response->headers->set('Cache-Control','no-store, no-cache, must-revalidate, max-age=0');

        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', '0');

        return $response;
    }
}
