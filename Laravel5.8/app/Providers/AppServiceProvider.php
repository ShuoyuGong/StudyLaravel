<?php

namespace App\Providers;

use App\Model\Admin\FriendshipLinks;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    //
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    // 获取网站配置信息
    $webConfig = $this->getWebConfig();
    // 获取友情链接信息
    $friendLinks = $this->getFriendLinks();
    View::share(['webConfig' => $webConfig, 'friendLinks' => $friendLinks]);
  }

  /***
   * 获取网站配置信息
   */
  public function getWebConfig()
  {
    $webConfig = DB::table('config')->get();
    $arr = [];
    foreach ($webConfig as $item) {
      $arr[$item->name] = json_decode($item->config);
    }
    return $arr;
  }

  /**
   * 获取友情链接信息
   */
  public function getFriendLinks()
  {
    // 获取友情链接
    $friendLinks = FriendshipLinks::OrderBy('sort', 'Desc')->OrderBy('id', 'Desc')->get();
    return $friendLinks;
  }
}
