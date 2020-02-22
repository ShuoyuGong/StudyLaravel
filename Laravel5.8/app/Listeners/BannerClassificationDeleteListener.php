<?php

namespace App\Listeners;

use App\Events\BannerClassificationDeleteEvent;
use App\Model\Admin\BannerItem;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Storage;

class BannerClassificationDeleteListener
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
   * @param  BannerClassificationDeleteEvent  $event
   * @return void
   */
  public function handle(BannerClassificationDeleteEvent $event)
  {
    $BannerItemData = BannerItem::where('BannerId', '=', $event->banner->id)->get();
    foreach ($BannerItemData as $v) {
      if ($v->picture !== "") {
        // 删除旧图片
        Storage::delete([$v->picture]);
      }
    }
    BannerItem::where('BannerId', '=', $event->banner->id)->delete();
  }
}
