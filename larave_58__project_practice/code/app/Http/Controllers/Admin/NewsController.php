<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreNewsPost;
use App\Libs\Baidu;
use App\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $NewsModel = new News;
        $list = $NewsModel::orderBy('created_at','Desc')->orderBy('id','Desc')->paginate(10);
        return view("admin.news.index")->with('list',$list);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.news.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewsPost $request)
    {
        //
        $NewsModel = new News;
        $NewsModel->title = $request->title;
        $NewsModel->keyword = $request->keyword;
        $NewsModel->desc = $request->desc;
        $NewsModel->remark = $request->remark;
        $NewsModel->views = $request->views;
        $NewsModel->content = $request->contents;
        if($request->file("file")){
            $NewsModel->pic = $request->file('file')->store('news');
        }
        checkreturn($NewsModel->save(),"新增");
        return redirect(route('admin.news.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        //
        return view('admin.news.edit')->with('news',$news);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        //
        $data =[
            'title'=>$request->title,
            'keyword'=>$request->keyword,
            'desc'=>$request->desc,
            'remark'=>$request->remark,
            'views'=>$request->views,
            'content'=>$request->contents,
        ];
        if($request->file("file")){
            $data['pic'] = $request->file('file')->store('news');
            //删除旧图片
            Storage::delete($news->pic);
        }
        $NewsModel = new News;
        $result = $NewsModel::where('id','=',$news->id)->update($data);
        checkreturn($result>0,"修改");
        return redirect(route('admin.news.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $newsN
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        //
//        $result = (new News)::destroy($news->id);
        $result = $news->delete();
        Storage::delete($news->pic);
        checkreturn($result,"删除");
        return redirect(route('admin.news.index'));
    }
    //百度推送
    public function baidusend(News $news){
        //
        $url = route('index.news.show',['news'=>$news->id]);
//        $url = "http://www.yfketang.cn/course-show/9.html";
        $result = Baidu::getInstance()->baidusend([$url]);
        checkreturn($result,"推送");
        return redirect(route('admin.news.index'));
    }
}
