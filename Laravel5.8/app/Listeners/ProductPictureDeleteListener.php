<?php

namespace App\Listeners;

use App\Events\ProductPictureDeleteEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Model\Admin\Product;
use Storage;

class ProductPictureDeleteListener
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
   * @param  ProductPictureDeleteEvent  $event
   * @return void
   */
  public function handle(ProductPictureDeleteEvent $event)
  {
    if ($event->product->picture !== "") {
      Storage::delete($event->product->picture);
    }
  }
}
