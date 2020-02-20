<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Events\CasesPictureDeleteEvent;

class Cases extends Model
{
  /***
   * 当删除时触发 ProductDeleteEvent 事件
   */
  protected $dispatchesEvents = [
    'deleted'    =>      CasesPictureDeleteEvent::class,
  ];
}
