<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\CompanyProfile;
use Carbon\Traits\Date;
use App\Http\Requests\CompanyProfilePOST;
use Storage;


class CompanyProfileController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $recruitList = CompanyProfile::where('type', '=', 2)->paginate(10);
    //招贤纳士 列表显示
    return view('admin.companyProfile.indexRecruit')->with('recruitList', $recruitList);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    // 获取公司简介初始值
    $companyProfileData = CompanyProfile::where('type', '=', 1)->first();
    //加载公司简介视图
    return view('admin.companyProfile.createCompanyProfile')->with('companyProfileData', $companyProfileData);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(CompanyProfilePOST $request)
  {
    $data = [
      'type'            =>      $request->type,
      'title'           =>      $request->title,
      'describe'        =>      isset($request->describe) ? $request->describe : '',
      'detail'          =>      isset($request->detail) ? $request->detail : '',
      'created_at'      =>      Date('Y-m-d H:i:s'),
      'updated_at'      =>      Date('Y-m-d H:i:s'),
    ];
    if ($request->file('picture')) {

      // 新图片地址保存进数据库
      $data['picture']    =     $request->file('picture')->store('companyProfile');
      // 删除旧图片
      Storage::delete($request->picture);
    }
    switch ($request->type) {
      case '1':
        $res = CompanyProfile::updateOrCreate(['type' => 1], $data);
        checkRes($res, '公司简介设置');
        return redirect(route('admin.companyProfile.create'));
        break;
      case '2':
        $res = CompanyProfile::updateOrCreate(['title' => $request->title], $data);
        checkRes($res, '招聘信息添加');
        return redirect(route('admin.companyProfile.index'));
        break;
      case '3':
        $res = CompanyProfile::updateOrCreate(['title' => $request->title], $data);
        checkRes($res, '发展历程信息添加');
        return redirect(route('admin.companyProfile.developmentHistory'));
        break;
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show()
  {
    //
    // dd($id);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(CompanyProfile $companyProfile)
  {
    // 招贤纳士 编辑页面 
    return view('admin.companyProfile.editRecruit')->with('companyProfileData', $companyProfile);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(CompanyProfilePOST $request, $id)
  {
    //验证通过 入库
    $CompanyProfileModel = CompanyProfile::find($id);
    $CompanyProfileModel->title            =          $request->title;
    $CompanyProfileModel->type            =          $request->type;
    $CompanyProfileModel->describe         =           $request->describe;
    if ($request->file('picture')) {
      // 删除旧图片
      Storage::delete($CompanyProfileModel->picture);
      // 新图片地址保存进数据库
      $CompanyProfileModel->picture    =     $request->file('picture')->store('companyProfile');
    }
    if ($request->type == 2) {
      checkRes($CompanyProfileModel->save(), '招聘信息编辑');
      return redirect(route('admin.companyProfile.index'));
    } elseif ($request->type == 3) {
      checkRes($CompanyProfileModel->save(), '发展历程信息编辑');
      return redirect(route('admin.companyProfile.developmentHistory'));
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(CompanyProfile $companyProfile)
  {
    if ($companyProfile->type == 2) {
      checkRes($companyProfile->delete(), '删除');
      return redirect(route('admin.companyProfile.index'));
    } elseif ($companyProfile->type == 3) {
      checkRes($companyProfile->delete(), '删除');
      return redirect(route('admin.companyProfile.developmentHistory'));
    }
  }


  /**
   * 加载 添加招聘信息 页面
   */
  public function createRecruit()
  {
    return view('admin.companyProfile.createRecruit');
  }

  /**
   * 加载 发展历程 页面
   */
  public function developmentHistory()
  {
    $recruitList = CompanyProfile::where('type', '=', 3)->paginate(10);
    //发展历程 列表显示
    return view('admin.companyProfile.indexDevelopmentHistory')->with('recruitList', $recruitList);
  }

  /**
   * 加载 添加历程 页面
   */
  public function createDevelopmentHistory()
  {
    return view('admin.companyProfile.createDevelopmentHistory');
  }

  /**
   * 加载 编辑历程 页面
   */
  public function editDevelopmentHistory(CompanyProfile $companyProfile)
  {
    return view('admin.companyProfile.editDevelopmentHistory')->with('companyProfileData', $companyProfile);
  }
}
