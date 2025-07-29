<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsSeller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next)
    {
        // If not logged in or not flagged as seller, forbid
        if (! auth()->check() || ! auth()->user()->is_seller) {
            abort(403, 'Unauthorized – seller access only.');
        }

        if (! auth()->check()
        || auth()->user()->seller_status !== 'approved') {
        abort(403, 'Unauthorized—seller access only.');
        }

        return $next($request);
    }
}
