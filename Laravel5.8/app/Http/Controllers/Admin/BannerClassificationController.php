<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BannerClassificationPOST;
use App\Model\Admin\Banner;

class BannerClassificationController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $bannerClassificationList = Banner::all();
    return view('admin.bannerClassification.indexBannerClassification')->with('bannerClassificationList', $bannerClassificationList);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admin.bannerClassification.createBannerClassification');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(BannerClassificationPOST $request)
  {
    $BannerModel = new Banner;
    $BannerModel->title = $request->title;
    $BannerModel->entitle = $request->entitle;
    checkRes($BannerModel->save(), '轮播图分类添加');
    return redirect(route('admin.bannerClassification.index'));
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
  public function edit(Banner $banner, $id)
  {
    $bannerClassificationData = Banner::where('id', $id)->first();
    return view('admin.bannerClassification.editBannerClassification')->with('bannerClassificationData', $bannerClassificationData);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(BannerClassificationPOST $request, $id)
  {
    $BannerModel = Banner::find($id);
    $BannerModel->title     =       $request->title;
    $BannerModel->entitle     =       $request->entitle;
    checkRes($BannerModel->save(), '编辑轮播图分类');
    return redirect(route('admin.bannerClassification.index'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Banner $banner, $id)
  {
    checkRes(Banner::destroy($id), '删除轮播图分类');
    return redirect(route('admin.bannerClassification.index'));
  }
}
