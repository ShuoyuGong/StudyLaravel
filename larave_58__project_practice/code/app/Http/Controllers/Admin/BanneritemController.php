<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use App\Banneritem;
use App\Http\Requests\StoreBanneritemPost;
use App\Http\Requests\StorePagePost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class BanneritemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Banneritem::OrderBy("sort","Desc")->OrderBy("id","Desc")->get();
        return view('admin.banneritem.index')->with('list',$list);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banners = Banner::all();
        return view('admin.banneritem.create')->with('banners',$banners);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBanneritemPost $request)
    {

        $banneritemModel = new Banneritem();
        $banneritemModel->banner_id = $request->banner_id;
        $banneritemModel->title = $request->title;
        $banneritemModel->digest = $request->digest;
        $banneritemModel->sort = $request->sort;
        $banneritemModel->isshow = isset($request->isshow)?$request->isshow:0;
        if($request->file("file")){
            $banneritemModel->pic = $request->file('file')->store('banner');
        }
        if($banneritemModel->pic==""){
//            Session::flash('errormsg',"图片不能为空");
            $request->session()->flash('errormsg',"图片不能为空");
            return redirect()->back();
        }
        checkreturn($banneritemModel->save(),"新增");
        return redirect(route('admin.banneritem.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Banneritem $banneritem)
    {
        $banners = Banner::all();
        return view('admin.banneritem.edit')->with('banneritem',$banneritem)->with('banners',$banners);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBanneritemPost $request, $id)
    {
        $banneritemModel = Banneritem::find($id);
        $banneritemModel->banner_id = $request->banner_id;
        $banneritemModel->title = $request->title;
        $banneritemModel->digest = $request->digest;
        $banneritemModel->sort = $request->sort;
        $banneritemModel->isshow = isset($request->isshow)?$request->isshow:0;
        if($request->file("file")){
            $banneritemModel->pic = $request->file('file')->store('banner');
        }
        checkreturn($banneritemModel->save(),"修改");
        return redirect(route('admin.banneritem.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banneritem $banneritem)
    {
        checkreturn($banneritem->delete(),"删除");
        return redirect(route('admin.banneritem.index'));
    }
//    排序
    public function setsort(Request $request){
        if($request->isMethod("POST")){
            $banneritmeModel = Banneritem::find($request->id);
            $banneritmeModel->sort=$request->sort;
            $result = $banneritmeModel->save();
        }
        if($result>0){
            return ['code'=>1,'msg'=>'操作成功'];
        }else{
            return ['code'=>0,'msg'=>'操作失败'];
        }
    }
}
