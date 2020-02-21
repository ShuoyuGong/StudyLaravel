<?php

namespace App\Listeners;

use App\Events\BannerPictureDeleteEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Storage;

class BannerPictureDeleteListener
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
   * @param  BannerPictureDeleteEvent  $event
   * @return void
   */
  public function handle(BannerPictureDeleteEvent $event)
  {
    /**
     * 对图片监听到的数据做判断
     * 如果图片存在就删除旧图片
     */
    if ($event->bannerItem->picture !== "") {
      Storage::delete($event->bannerItem->picture);
    }
  }
}
