<?php

namespace App\Http\Controllers\Home;

use App\Banner;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    protected $banner;

    public function __construct()
    {
        //获取banner
        $banner = Banner::where('entitle','=','product')->first();
        $this->banner  = $banner->banneritem[0];
    }

    //产品列表
    public function index(){
        //获取产品列表
        $list = Product::OrderBy('created_at',"Desc")->OrderBy('id',"Desc")->paginate(8);

        return view('home.product.index')->with('list',$list)->with('banners',$this->banner);
    }

    //产品详情
    public function show(Product $product){
        //浏览次自增
        Product::where('id',$product->id)->increment('views',1);
        return view('home.product.show')->with('product',$product)->with('banners',$this->banner);
    }
}
