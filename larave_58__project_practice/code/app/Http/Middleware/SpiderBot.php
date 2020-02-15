<?php

namespace App\Http\Middleware;

use Closure;

class SpiderBot
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
        \App\Libs\Spiderbot::getInstance();
        return $next($request);
    }
}
