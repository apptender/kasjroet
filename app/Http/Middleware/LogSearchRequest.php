<?php

namespace App\Http\Middleware;

use App\Log;
use Closure;

class LogSearchRequest
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
        $response = $next($request);

        Log::create([
           'ip' => $request->ip(),
            'user_agent' => $request->server('HTTP_USER_AGENT'),
            'referer' => $request->server('HTTP_REFERER'),
            'query' => $request->search
        ]);

        return $response;
    }
}
