<?php

namespace App\Http\Controllers\Home;

use App\Banner;
use App\Http\Controllers\Controller;
use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected $banner;

    public function __construct()
    {
        //获取banner
        $banner = Banner::where('entitle','=','news')->first();
        $this->banner  = $banner->banneritem[0];
    }
    // 列表
    public function index(){
        $list = News::OrderBy('created_at','Desc')->OrderBy('id','Desc')->paginate(10);
        return view('home.news.index')->with('list',$list)->with('banners',$this->banner);
    }

    //详情
    public function show(News $news){
        News::where('id',$news->id)->increment('views',1);
        return view('home.news.show')->with('news',$news)->with('banners',$this->banner);
    }
}
