<?php

namespace App\Model\Admin;

use App\Events\BannerClassificationDeleteEvent;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
  // 取消默认往数据库中写入的created_at和updated_at字段
  public $timestamps = false;

  /***
   * 当删除时触发 ProductDeleteEvent 事件
   */
  protected $dispatchesEvents = [
    'deleted'    =>      BannerClassificationDeleteEvent::class,
  ];


  protected function bannerItem()
  {
    return $this->hasMany(BannerItem::class, 'BannerId');
  }
}
