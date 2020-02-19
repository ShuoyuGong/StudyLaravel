<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckCategory;

class CategoryController extends Controller
{
  /**
   * 分类列表 页面显示
   */
  public function index()
  {
    // 获取分类数据
    $categoryData = Category::getClassificationList();
    return view('admin.category.index')->with('categoryData', $categoryData);
  }

  /**
   * 添加分类 页面显示
   */
  public function create(CheckCategory $request)
  {
    // 判断请求方式
    if ($request->isMethod('POST')) {
      // 实例化模型
      $categoryModel = new Category();
      $categoryModel->name = $request->categoryName;
      $categoryModel->pid = $request->categoryPid;
      $categoryModel->sort = $request->categorySort;
      $res = $categoryModel->save();
      checkRes($res, '添加');
      return redirect(route('admin.category.index'));
    }
    // 获取模型中数据进行重新编排
    $cates = Category::getClassificationList();
    return view('admin.category.create')->with('cates', $cates);
  }

  /**
   * 编辑分类
   */
  public function edit(Category $cateID, CheckCategory $request)
  {
    // 判断请求方式
    if ($request->isMethod('POST')) {
      $cateID->name = $request->categoryName;
      $cateID->pid = $request->categoryPid;
      $cateID->sort = $request->categorySort;
      $res = $cateID->save();
      checkRes($res, '编辑');
      return redirect(route('admin.category.index'));
    }
    // 获取模型中数据进行重新编排
    $cates = Category::getClassificationList();
    return view('admin.category.edit')->with(['cates' => $cates, 'cateID' => $cateID]);
  }

  /**
   * 删除分类
   */
  public function destroy(Category $cateID)
  {
    $res = $cateID->delete();
    checkRes($res, '删除');
    return redirect(route('admin.category.index'));
  }
}
