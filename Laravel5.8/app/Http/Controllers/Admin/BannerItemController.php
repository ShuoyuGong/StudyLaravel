<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BannerItemPOST;
use App\Model\Admin\Banner;
use App\Model\Admin\BannerItem;
use DB;
use Illuminate\Support\Facades\Storage;

class BannerItemController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Banner $banner)
  {
    $bannerItemList = BannerItem::OrderBy('sort', 'Desc')->OrderBy('id', 'Desc')->get();
    // $bannerTitle = DB::table('banner_items')->join('banners', 'banner_items.BannerId', '=', 'banners.id')->get();
    return view('admin.bannerItem.indexBannerItem')->with('bannerItemList', $bannerItemList);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $banners = Banner::all();
    return view('admin.bannerItem.createBannerItem')->with('banners', $banners);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(BannerItemPOST $request)
  {
    $BannerItemModel = new BannerItem;
    $BannerItemModel->title    =    $request->title;
    $BannerItemModel->BannerId    =    $request->BannerId;
    $BannerItemModel->digest   =    $request->digest;
    $BannerItemModel->sort     =    $request->sort;
    $BannerItemModel->isShow     =   isset($request->isShow) ? $request->isShow : 0;
    if ($request->file('picture')) {
      // 图片地址保存进数据库
      $BannerItemModel->picture    =     $request->file('picture')->store('bannerItem');
      checkRes($BannerItemModel->save(), '添加轮播图项目');
    } else {
      noPicture('添加轮播图项目');
      return redirect()->back();
    }
    return redirect(route('admin.bannerItem.index'));
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
  public function edit(BannerItem $bannerItem)
  {
    $bannerItemData = $bannerItem;
    $banners = Banner::all();
    return view('admin.bannerItem.editBannerItem')->with('bannerItemData', $bannerItemData)->with('banners', $banners);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(BannerItemPOST $request, $id)
  {
    $BannerItemModel                      =          BannerItem::find($id);
    $BannerItemModel->title               =          $request->title;
    $BannerItemModel->digest              =          $request->digest;
    $BannerItemModel->sort                =          $request->sort;
    $BannerItemModel->BannerId            =          $request->BannerId;
    $BannerItemModel->isShow              =          isset($request->isShow) ? $request->isShow : '0';
    if ($request->file('picture')) {
      // 删除旧图片
      Storage::delete($BannerItemModel->picture);
      $BannerItemModel->picture    =     $request->file('picture')->store('bannerItem');
      checkRes($BannerItemModel->save(), '编辑轮播图项目信息');
    } else {
      noPicture('编辑轮播图项目');
      return redirect()->back();
    }
    return redirect(route('admin.bannerItem.index'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(BannerItem $bannerItem)
  {

    checkRes($bannerItem->delete(), '删除轮播图项目');
    return redirect(route('admin.bannerItem.index'));
  }

  /**
   * jquery ajax 异步排序
   */
  public function setSort(Request $request)
  {
    if ($request->isMethod("POST")) {
      $BannerItemModel = BannerItem::find($request->dataId);
      $BannerItemModel->sort = $request->sort;
      $result = $BannerItemModel->save();
      if ($result > 0) {
        return ['status' => 1];
      } else {
        return ['status' => 0];
      }
    }
  }
}
