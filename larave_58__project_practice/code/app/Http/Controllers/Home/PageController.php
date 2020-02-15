<?php

namespace App\Http\Controllers\Home;

use App\Banner;
use App\Http\Controllers\Controller;
use App\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    protected $banner;

    public function __construct()
    {
        //获取banner
        $banner = Banner::where('entitle','=','about')->first();
        $this->banner  = $banner->banneritem[0];
    }
    public function index(){
        //获取公司简介
        $jianjie = Page::where('type',1)->first();
        //获取招贤纳士
        $zxns = Page::where('type',2)->get();
        //获取发展历程
        $licheng = Page::where('type',3)->OrderBy("created_at","Desc")->get();
        return view('home.page.index')->with('jianjie',$jianjie)->with('zxns',$zxns)->with('licheng',$licheng)->with('banners',$this->banner);
    }
}
