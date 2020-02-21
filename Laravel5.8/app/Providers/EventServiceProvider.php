<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
  /**
   * The event listener mappings for the application.
   *
   * @var array
   */
  protected $listen = [
    Registered::class => [
      SendEmailVerificationNotification::class,
    ],
    /***
     * 教程7-8
     * 添加事件 与 监听文件
     * 用于产品模块 删除产品时产品图片的单个或批量删除
     * 执行 php artisan event:generate 创建文件
     */
    'App\Events\ProductPictureDeleteEvent' => [
      'App\Listeners\ProductPictureDeleteListener',
    ],
    // 案例图片删除监听
    'App\Events\CasesPictureDeleteEvent' => [
      'App\Listeners\CasesPictureDeleteListener',
    ],
    // 轮播图 图片 删除监听
    'App\Events\BannerPictureDeleteEvent' => [
      'App\Listeners\BannerPictureDeleteListener',
    ],
  ];

  /**
   * Register any events for your application.
   *
   * @return void
   */
  public function boot()
  {
    parent::boot();

    //
  }
}
