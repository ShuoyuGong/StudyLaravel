<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Banner;
use App\Model\Admin\CompanyProfile;

class AboutUsController extends Controller
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
   * 关于获取到所有数据并绑定
   */
  public function getAboutUsList()
  {
    $company_profile_list = CompanyProfile::where('type', 1)->OrderBy('Created_at', 'Desc')->first();
    $recruit_list = CompanyProfile::where('type', 2)->OrderBy('Created_at', 'Desc')->get();
    $development_history_list = CompanyProfile::where('type', 3)->OrderBy('Created_at', 'Desc')->first();
    return view('home.aboutUs.index')->with('company_profile_list', $company_profile_list)->with('recruit_list', $recruit_list)->with('development_history_list', $development_history_list);
  }
}
