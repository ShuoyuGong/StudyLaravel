<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpParser\Node\Stmt\Case_;
use App\Model\Admin\Cases;

// 引入 表单数据入库验证文件 StoreCasePost
use App\Http\Requests\StoreCasePost;
use Storage;

class CaseController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //获取案例数据列表
    $casesList = Cases::OrderBy('sort', 'Desc')->OrderBy('id', 'Desc')->paginate(15);
    return view('admin.cases.indexCase')->with('casesList', $casesList);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
    return view('admin.cases.createCase');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreCasePOST $request)
  {
    //处理添加的案例
    $CasesModel = new Cases;
    $CasesModel->title = $request->title;
    $CasesModel->abstract = $request->abstract;
    $CasesModel->sort = $request->sort;
    if ($request->file('picture')) {
      $CasesModel->picture = $request->file('picture')->store('cases');
    }
    checkRes($CasesModel->save(), '添加');
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
    //
    // dd($case);
    return view('admin.cases.editCase')->with('cases', $case);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(StoreCasePost  $request, $id)
  {
    //验证通过 入库
    $CasesModel = Cases::find($id);
    $CasesModel->title            =           $request->title;
    $CasesModel->abstract         =           $request->abstract;
    $CasesModel->sort             =           $request->sort;
    if ($request->file('picture')) {
      // 删除旧图片
      Storage::delete($CasesModel->picture);
      // 新图片地址保存进数据库
      $CasesModel->picture    =     $request->file('picture')->store('cases');
    }
    checkRes($CasesModel->save(), '编辑');
    return redirect(route('admin.cases.index'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   * 共有三种情况
   * 1.用户删除一条数据 $id默认等于0
   * 2.用户删除多条数据 $request->ids 是用户多选删除的ID数组
   * 3.用户直接点击批量删除按钮 没有ID数据 返回闪存信息
   */
  public function destroy(Request $request, $id)
  {
    $ids = [];
    if ($id != 0) {
      $ids[] = $id;
    } else {
      if ($request->has('ids')) {
        $ids = $request->ids;
      } else {
        session()->flash('arrMsg', ['class' => 'warning', 'msg' =>  '请先勾选您要删除的产品！']);
        return redirect(route('admin.cases.index'));
      }
    }
    $res = Cases::destroy($ids);
    checkRes($res > 0, '删除');
    return redirect(route('admin.cases.index'));
  }
}
