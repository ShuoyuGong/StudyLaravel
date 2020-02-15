<?php

namespace App;

use App\Events\ProductDeleteEvent;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $dispatchesEvents =[
        'deleted'=> ProductDeleteEvent::class,
    ];
    public function category(){
        return $this->belongsTo('App\Category','cid');
    }
}
