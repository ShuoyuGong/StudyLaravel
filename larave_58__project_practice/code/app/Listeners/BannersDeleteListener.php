<?php

namespace App\Listeners;

use App\Banneritem;
use App\Events\BannersDeleteEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;

class BannersDeleteListener
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
     * @param  BannersDeleteEvent  $event
     * @return void
     */
    public function handle(BannersDeleteEvent $event)
    {
//        $banneritem = Banneritem::where('banner_id','=',$event->banners->id)->get();
//        foreach ($banneritem as $v){
//            if($v->pic!==""){
//                Storage::delete([$v->pic]);
//            }
//        }
//        Banneritem::where('banner_id','=',$event->banners->id)->delete();
         $banneritems = Banneritem::where('banner_id','=',$event->banners->id)->get();
         $banneritems->each(function ($item, $key) {
             $item->delete();
         });
    }
}
