<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Banner;
use App\Model\Admin\Product;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
  protected $banner;
  public function __construct()
  {
    // 获取背景Banner 获取到的是数组
    $banner = Banner::where('entitle', '=', 'ProductBanner')->first();
    // 将数组中的第0个提取到 $this->banner
    $this->banner = $banner->bannerItem[0];
  }
  public function index()
  {
    // DB获取产品信息
    $product = Product::OrderBy('created_at', 'Desc')->OrderBy('id', 'Desc')->paginate(4);

    // 显示产品页面
    return view('home.product.index')->with('product', $product)->with('banner', $this->banner);
  }

  public function showProductDetail(Product $productDetailID)
  {
    DB::table('products')->where('id', '=', $productDetailID->id)->increment('views', 1);
    return view('home.product.productDetail')->with('productDetailID', $productDetailID)->with('banner', $this->banner);
  }
}
