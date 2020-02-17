<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 引入DB类
use DB;
use PhpParser\Node\Expr\FuncCall;
// 验证类
use Validator;

class ConfigController extends Controller
{
  //
  public function setConfig()
  {
    $config = $this->getConfig('setConfig');
    return view('admin.config.setConfig')->with('config', $config);
  }

  // 数据验证
  public function keyDataValidation($name = 'setConfig', $request)
  {
    switch ($name) {
      case 'informationConfig':
        $dataValidate = $request->validate([
          'companyName' => 'required',
          'companyAddress' => 'required',
          'companyPhone' => 'required',
          'companyEmail' => 'required|email',
          'customerServiceHotline' => 'required',
          'recordNumber' => 'required',
        ], [
          'companyName.required' => '公司名称不能为空',
          'companyAddress.required' => '公司地址不能为空',
          'companyPhone.required' => '公司电话不能为空',
          'companyEmail.required' => '公司邮箱不能为空',
          'customerServiceHotline.required' => '客服热线不能为空',
          'recordNumber.required' => '备案号不能为空',
          'companyEmail.email'  => '公司邮箱地址格式不正确',
        ]);
        break;
      case 'baiduConfig':
        $dataValidate = $request->validate([
          'baiduSecretKey' => 'required',
        ], [
          'baiduSecretKey.required' => '百度密钥不能为空',
        ]);
        break;
      default:
        $dataValidate = $request->validate([
          'name' => 'required',
          'title' => 'required',
          'webName' => 'required',
          'webDomain' => 'required|url',
          'webKeyWord' => 'required',
          'webDescribe' => 'required',
          'websiteStatus' => 'required|boolean',
          'stationClosingHint' => 'required',
        ], [
          'name.required' => '配置标识不能为空',
          'title.required' => '配置名称不能为空',
          'webName.required' => '网站名称不能为空',
          'webDomain.required' => '网站域名不能为空',
          'webKeyWord.required' => '网站关键字不能为空',
          'webDescribe.required' => '网站描述不能为空',
          'websiteStatus.required' => '网站状态不能为空',
          'stationClosingHint.required' => '关站提示不能为空',
          'websiteStatus.boolean' => '网站状态必须为1或者0',
          'webDomain.url' => '网站域名书写错误',
        ]);
        break;
    }
  }
  // 数据入库
  public function store(Request $request)
  {
    $this->keyDataValidation($request->name, $request);
    $data = $request->only('name', 'title');
    // 存入网站配置信息
    $data['config']  = json_encode($request->except('name', 'title', '_token'));
    // 存入创建时间字段信息
    $data['created_at'] = date('Y-m-d H:i:s', time());
    // 存入更新时间字段信息
    $data['updated_at'] = date('Y-m-d H:i:s', time());
    $config = DB::table('config')
      ->where('name', '=', $request->name)
      ->first();
    if ($config) {
      $res = DB::table('config')
        ->where('name', '=', $request->name)
        ->update($data);
    } else {
      $res = DB::table('config')->insert($data);
    }
    if ($res == true || $res > 0) {
      session()->flash('arrMsg', ['class' => 'success', 'msg' => '保存成功']);
    } else {
      session()->flash('arrMsg', ['class' => 'danger', 'msg' => '保存失败']);
    }
    return redirect(route('admin.config.' . $request->name));
  }

  // 基本信息配置界面
  public function informationConfig()
  {
    $config = $this->getConfig('informationConfig');
    return view('admin.config.informationConfig')->with('config', $config);
  }

  //  百度推送
  public function baiduConfig()
  {
    $config = $this->getConfig('baiduConfig');
    return view('admin.config.baiduConfig')->with('config', $config);
  }

  // 根据配置标识获取信息
  private function getConfig($name = 'setConfig')
  {
    //  从数据库中获取数据
    $resConfig  = DB::table('config')
      ->where('name', '=', $name)
      ->first();
    // 定一个空数组，如果数据库中没有数据 便返回空数组 前台不会报错
    $config = [];
    if ($resConfig) {
      $config = json_decode($resConfig->config);
    }
    return $config;
  }
}
