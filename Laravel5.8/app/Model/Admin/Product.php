<?php

namespace App\Model\Admin;

use App\Events\ProductPictureDeleteEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class  Product extends Model
{
  /***
   * 当删除时触发 ProductDeleteEvent 事件
   */
  protected $dispatchesEvents = [
    'deleted'    =>      ProductPictureDeleteEvent::class,
  ];

  public function category()
  {
    return $this->belongsTo('App\Model\Admin\Category', 'cId');
  }
}
