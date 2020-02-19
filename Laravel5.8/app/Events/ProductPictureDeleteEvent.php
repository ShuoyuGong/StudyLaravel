<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Model\Admin\Product;
// use App\Events\ProductPictureDeleteEvent;

/***
 * 教程7-8
 * 添加事件 与 监听文件
 * 用于产品模块 删除产品时产品图片的单个或批量删除
 * 执行 php artisan event:generate 创建文件
 * 注册文件在APP\Providers\EventServiceProvider\protected $listen
 * 监听文件在APP\Listeners\ProductPictureDeleteListener
 */

class ProductPictureDeleteEvent
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  /***
   * 自定义product用来接收删除的数据
   */
  public $product;
  /**
   * Create a new event instance.
   *
   * @return void
   */
  public function __construct(Product $product)
  {
    $this->product = $product;
  }

  /**
   * Get the channels the event should broadcast on.
   *
   * @return \Illuminate\Broadcasting\Channel|array
   */
  public function broadcastOn()
  {
    return new PrivateChannel('channel-name');
  }
}
