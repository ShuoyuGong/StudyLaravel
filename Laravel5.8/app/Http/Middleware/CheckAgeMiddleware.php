<?php

namespace App\Http\Middleware;

use Closure;

class CheckAgeMiddleware
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
    // 前置中间件
    // if ($request->age > 200) {
    //   return redirect('/home');
    // }
    // // 将命令放在返回的数据前面执行
    // $request->age = $request->age + 1;
    // return $next($request);

    // 后置中间件
    // if ($request->age > 200) {
    //   return redirect('/home');
    // }
    // 先用变量接收 中间件的执行结果
    $res = $next($request);
    // 将命令放在返回的数据后面执行
    // $request->age = $request->age + 1;
    return $res;
  }
}
