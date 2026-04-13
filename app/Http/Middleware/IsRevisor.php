<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Symfony\Component\HttpFoundation\Response;

class IsRevisor
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->is_revisor) {
            return $next($request);
        }

        return redirect()->route('home')->with('error', Lang::get('revisor.revisor_only_area'));
    }
}
