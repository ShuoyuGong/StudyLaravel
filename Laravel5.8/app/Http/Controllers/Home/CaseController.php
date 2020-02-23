<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Banner;
use App\Model\Admin\Cases;

class CaseController extends Controller
{
  /**
   * 定义banner 
   */
  protected $banner;

  public function __construct()
  {
    $banner = Banner::where('entitle', 'CaseBanner')->first();
    //将数组中的第0个提取到 $this->banner
    $this->banner = $banner->bannerItem[0];
  }

  /**
   * 案例首页显示 以及数据绑定
   */
  public function getCaseList()
  {
    $case_list = Cases::OrderBy('sort', 'Desc')->OrderBy('created_at', 'Desc')->paginate();
    return view('home.case.index')->with('case_list', $case_list)->with('banner', $this->banner);
  }
}
