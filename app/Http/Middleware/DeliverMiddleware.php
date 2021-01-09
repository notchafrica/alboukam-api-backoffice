<?php

namespace App\Http\Middleware;

use App\Models\Deliver;
use Closure;
use Illuminate\Http\Request;

class DeliverMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth('sanctum')->user() instanceof Deliver) {
            abort(403);
        }
        return $next($request);
    }
}
