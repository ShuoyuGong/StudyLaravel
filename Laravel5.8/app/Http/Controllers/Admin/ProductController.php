<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductVerificationPOST;
use App\Model\Admin\Category;
// 引入 产品 模型
use App\Model\Admin\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    // 获取模型中数据进行重新编排
    $ProductModel = new Product;
    $catesList = Product::OrderBy('created_at', 'Desc')->OrderBy('id', 'Desc')->paginate(15);
    return view('admin.product.indexProduct')->with('catesList', $catesList);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
    $catesCreate = Category::getClassificationList();
    return view('admin.product.createProduct')->with('catesCreate', $catesCreate);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request  
   * @return \Illuminate\Http\Response
   */
  public function store(ProductVerificationPOST $request)
  {
    //验证通过 入库
    $ProductModel = new Product();
    $ProductModel->title            =          $request->title;
    $ProductModel->cid              =           $request->cid;
    $ProductModel->keyWord          =           $request->keyWord;
    $ProductModel->views            =           $request->views;
    $ProductModel->isRecommend      =           $request->isRecommend ? $request->isRecommend : 0;
    $ProductModel->describe         =           $request->describe;
    $ProductModel->abstract         =           $request->abstract;
    $ProductModel->content          =           $request->content;
    if ($request->file('picture')) {
      $ProductModel->picture    =     $request->file('picture')->store('product');
    }
    checkRes($ProductModel->save(), '新增');
    return redirect(route('admin.product.index'));
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
  public function edit(Product $product)
  {
    $catesCreate = Category::getClassificationList();
    return view('admin.product.editProduct')->with('product', $product)->with('catesCreate', $catesCreate);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(ProductVerificationPOST $request, $id)
  {
    //验证通过 入库
    $ProductModel = Product::find($id);
    $ProductModel->title            =           $request->title;
    $ProductModel->cid              =           $request->cid;
    $ProductModel->keyWord          =           $request->keyWord;
    $ProductModel->views            =           $request->views;
    $ProductModel->isRecommend      =           $request->isRecommend ? $request->isRecommend : 0;
    $ProductModel->describe         =           $request->describe;
    $ProductModel->abstract         =           $request->abstract;
    $ProductModel->content          =           $request->content;
    if ($request->file('picture')) {
      // 删除旧图片
      Storage::delete($ProductModel->picture);
      // 新图片地址保存进数据库
      $ProductModel->picture    =     $request->file('picture')->store('product');
    }
    checkRes($ProductModel->save(), '编辑');
    return redirect(route('admin.product.index'));
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
        return redirect(route('admin.product.index'));
      }
    }
    $res = Product::destroy($ids);
    checkRes($res > 0, '删除');
    return redirect(route('admin.product.index'));
  }
}
