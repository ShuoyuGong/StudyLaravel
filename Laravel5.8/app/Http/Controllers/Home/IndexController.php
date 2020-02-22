<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Banner;
use App\Model\Admin\Cases;
use App\Model\Admin\FriendshipLinks;
use App\Model\Admin\Product;

class IndexController extends Controller
{
  public function index()
  {
    //获取轮播图的信息
    $banners = Banner::where('entitle', '=', 'IndexBanners')->first();
    // 获取核心产品
    $product = Product::OrderBy('created_at', 'Desc')->OrderBy('id', 'Desc')->where('isRecommend', '=', 1)->take(4)->get();
    // 获取案例内容
    $case = Cases::OrderBy('created_at', 'Desc')->OrderBy('sort', 'Desc')->OrderBy('id', 'Desc')->take(4)->get();
    return view('home.index.index')->with('banners', $banners)->with('product', $product)->with('case', $case);
  }
}
