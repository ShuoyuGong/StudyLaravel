<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Requests\CheckCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class CategoryController extends Controller
{
    //
    /**
     * 分类列表
     */
    public function index(){
        $list = Category::getcates();
        return view('admin.category.index')->with("list",$list);
    }

    /**
     * 添加分类
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(CheckCategory $request){
        if($request->isMethod("POST")){
            $category = new Category();
            $category->name = $request->name;
            $category->sort = $request->sort;
            $category->pid = $request->pid;
            $result = $category->save();
            checkreturn($result,"添加");
            return redirect(route('admin.category.list'));
        }
        $cates = Category::getcates();
        return view("admin.category.create")->with('cates',$cates);
    }


    public function edit(CheckCategory $request,Category $category){
        if($request->isMethod("POST")){
            $category->name = $request->name;
            $category->sort = $request->sort;
            $category->pid = $request->pid;
            $result = $category->save();
            checkreturn($result,"编辑");
            return redirect(route('admin.category.list'));
        }
        $cates = Category::getcates();
        return view('admin.category.edit')->with("cate",$category)->with('cates',$cates);
    }

    /**
     * 分类删除
     */
    public function destory(Category $cate){
        $result = $cate->delete();
        checkreturn($result,"删除");
        return redirect(route('admin.category.list'));
    }
}
