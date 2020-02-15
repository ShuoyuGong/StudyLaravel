<?php

namespace App\Http\Middleware;

use Closure;

class CheckAge
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
        if($request->age<=200){
//            return redirect(route("home"));
            return redirect("/home");
        }
        dump("中间件：".$request->age);
        $response = $next($request);
        $request->age =202;
        return $response;
    }
}
