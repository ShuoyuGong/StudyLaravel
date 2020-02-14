<?php

namespace App\Http\Middleware;

use Closure;

class LogRecordMiddleware
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
    // [2019-10-10 10:10:10 127.0.0.1 ---- /Admin/User/index]
    // 记录该请求路径
    $path = $request->path();
    // 拼接字符串
    $str = '[' . date('Y-m-d H:i:s') . ']' . $request->ip() . '--------' . $request->path();
    // 将信息记录在日志中
    file_put_contents('request.log', $str . "\r\n", FILE_APPEND);
    // 进入到下一层中间件代码执行
    return $next($request);
  }
}
