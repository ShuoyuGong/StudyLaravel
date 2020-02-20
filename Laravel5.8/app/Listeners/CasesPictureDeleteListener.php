<?php

namespace App\Listeners;

use App\Events\CasesPictureDeleteEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Storage;

class CasesPictureDeleteListener
{
  /**
   * Create the event listener.
   *
   * @return void
   */
  public function __construct()
  {
    //
  }

  /**
   * Handle the event.
   *
   * @param  CasesPictureDeleteEvent  $event
   * @return void
   */
  public function handle(CasesPictureDeleteEvent $event)
  {
    /**
     * 对图片监听到的数据做判断
     * 如果图片存在就删除旧图片
     */
    if ($event->cases->picture !== "") {
      Storage::delete($event->cases->picture);
    }
  }
}
