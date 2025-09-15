<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CheckDBConnectionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try{
            DB::connection()->getPdo();
            return $next($request);
        }catch (\Throwable $e){
            return response()->json([
                'message' => 'Error with database connection',
                'error' => $e->getMessage()
            ], 503);
        }

    }
}
