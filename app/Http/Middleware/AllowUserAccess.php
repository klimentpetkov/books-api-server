<?php

namespace App\Http\Middleware;

use App\Constants;
use Closure;

class AllowUserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user() && auth()->user()->isReader()) {
            return response()->json(['message' => Constants::ACCESS_DENIED], Constants::STATUS_OK);
        }

        return $next($request);
    }
}
