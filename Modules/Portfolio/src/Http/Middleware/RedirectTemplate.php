<?php

namespace Portfolio\Http\Middleware;

use Illuminate\Http\Request;

class RedirectTemplate
{
    public function handle(Request $request, \Closure $next)
    {
        // if ($request->hasHeader('htmx-template')) {
        //     return $next($request);
        // }
        // return redirect('/');

        return $next($request);
    }
}