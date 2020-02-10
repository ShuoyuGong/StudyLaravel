<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GoodsController extends Controller
{
    //index
    public function getIndex()
    {
      echo 'Index首页';
    }

    // 商品的显示功能
    public function getShow()
    {
      echo '商品的显示';
    }

    // 商品的添加
    public function getAdd()
    {
      return view('goodsAdd');
    }

     // 商品的显示
     public function postSelect()
     {
       echo '商品的显示';
     }
}
