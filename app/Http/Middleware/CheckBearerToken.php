<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckBearerToken
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->bearerToken()) {
            return response()->json([
                'message' => 'You are thief. First get token and then use the token to access this.'
            ], 401);
        }

        return $next($request);
    }
}
 