<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StorePagePost;
use App\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 招贤纳士列表
        $list = Page::where("type",'=',2)->get();
        return view('admin.page.index')->with('list',$list);
    }
    //发展历程列表
    public function licheng()
    {
        // 发展历程列表
        $list = Page::where("type",'=',3)->get();
        return view('admin.page.licheng')->with('list',$list);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //获取公司简介信息
        $com = Page::where("type",'=',1)->first();
        // 加载公司简介视图
        return view('admin.page.create')->with('jianjie',$com);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePagePost $request)
    {
        $data=[
            'type'=>$request->type,
            'title'=>$request->title,
            'remark'=>isset($request->remark)?$request->remark:"",
            'pic'=>isset($request->pic)?$request->pic:"",
            'content'=>isset($request->contents)?$request->contents:"",
        ];
        if($request->file("file")){
            $data['pic'] = $request->file('file')->store('page');
        }
        switch ($request->type){
            case "1":
                $result = Page::updateOrCreate(['type'=>1],$data);
                checkreturn($result instanceof Page,"更新");
                return redirect(route('admin.page.create'));
                break;
            case "2":
                $result = Page::updateOrCreate(['title'=>$request->title],$data);
                checkreturn($result instanceof Page,"添加");
                return redirect(route('admin.page.index'));
                break;
            case "3":
                $result = Page::updateOrCreate(['title'=>$request->title],$data);
                checkreturn($result instanceof Page,"添加");
                return redirect(route('admin.page.licheng'));
                break;
        }
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
    public function edit(Page $page)
    {
        //编辑招贤纳士
        return view('admin.page.editzx')->with('page',$page);
    }
    //编辑发展历程
    public function editlc(Page $page)
    {
        //编辑招贤纳士
        return view('admin.page.editlc')->with('page',$page);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePagePost $request, $id)
    {
        $PageModel = Page::find($id);
        $PageModel->title = $request->title;
        $PageModel->content = $request->contents;
        if($request->file("file")){
            $PageModel->pic = $request->file('file')->store('page');
            //删除旧图片
            Storage::delete($request->pic);
        }
        checkreturn($PageModel->save(),"编辑");
        if($request->type==2){
            return redirect(route('admin.page.index'));
        }else{
            return redirect(route('admin.page.licheng'));
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        checkreturn($page->delete(),"删除");

        if($page->type==2){
            return redirect(route('admin.page.index'));
        }else{
            return redirect(route('admin.page.licheng'));
        }
    }

    //加载添加招贤纳士页面
    public function createzx()
    {
        // 加载公司简介视图
        return view('admin.page.createzx');
    }
    //加载添加发展历程页面
    public function createlc()
    {
        // 加载公司简介视图
        return view('admin.page.createlc');
    }
}
