<?php

namespace App\Http\Controllers\Admin;

use App\Cases;
use App\Http\Requests\StoreCasesPost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //获取案例列表数据
        $list = Cases::OrderBy('sort',"Desc")->OrderBy('id',"Desc")->paginate(10);
        return view("admin.case.index")->with('list',$list);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //加载视图
        return view("admin.case.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCasesPost $request)
    {
        $CasesModel = new Cases;
        $CasesModel->title = $request->title;
        $CasesModel->remark = $request->remark;
        $CasesModel->sort = $request->sort;
        if($request->file("file")){
            $CasesModel->pic = $request->file('file')->store('cases');
        }
        checkreturn($CasesModel->save(),"新增");
        return redirect(route('admin.cases.index'));
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
    public function edit(Cases $case)
    {
        return view('admin.case.edit')->with('cases',$case);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCasesPost $request, $id)
    {

        $CasesModel = Cases::find($id);
        $CasesModel->title = $request->title;
        $CasesModel->remark = $request->remark;
        $CasesModel->sort = $request->sort;
        if($request->file("file")){
            $CasesModel->pic = $request->file('file')->store('cases');
            //删除旧图片
            Storage::delete($request->pic);
        }
        checkreturn($CasesModel->save(),"编辑");
        return redirect(route('admin.cases.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $ids =[];
        if($id!=0){
            $ids[]=$id;
        }else{
            if($request->has('ids')){
                $ids = $request->ids;
            }
        }
        $counts = Cases::destroy($ids);
        checkreturn($counts>0,"删除");
        return redirect(route('admin.cases.index'));
    }
}
