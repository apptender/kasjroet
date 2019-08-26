<?php

namespace App\Http\Middleware;

use Closure;

class IPAddresses
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
        $ips = [
            '192.168.10.1',
            '95.85.5.151'
        ];

        if (!in_array($request->ip(), $ips)) {
            abort(403);
        }
        return $next($request);
    }
}
