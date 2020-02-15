<?php

namespace App\Http\Controllers\Admin;

use App\Cases;
use App\News;
use App\Product;
use App\Spiderbot;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //
    public function index(){
        //文章数、产品数、案例数
        $newscount = News::count();
        $productcount = Product::count();
        $casescount = Cases::count();
        //蜘蛛来访
        $spider = Spiderbot::all();
        return view("admin.index.index")->with('newscount',$newscount)->with('productcount',$productcount)->with('casescount',$casescount)->with('spider',$spider);
    }

    //编辑器图片上传接口
    public function imgupload(Request $request){
        $info = [
            'code'=>200,
            "url"=>''
        ];
        if($request->file("file")){
            $info['url'] = "/uploads/".$request->file("file")->store("news/editor");
        }else{
            $info['code']=400;
        }
        return $info;
    }
}
