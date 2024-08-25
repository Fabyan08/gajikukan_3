<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekActivate
{
    public function handle(Request $request, Closure $next, ...$statuss)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        foreach ($statuss as $status) {
            if (auth()->user()->status == $status) {
                return $next($request);
            }
        }

        return redirect()->route('dashboard.index');
    }
}
