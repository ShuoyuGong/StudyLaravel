<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class LoginController extends Controller
{
  // 加载登陆表单
  public function index()
  {
    if (Auth::check()) {
      return redirect(route('admin.index'));
    } else {
      return view('admin.login.indexLogin');
    }
  }

  // 登陆
  public function doLogin(Request $request)
  {
    if ($request->username == "" || $request->password == "") {
      session()->flash('arrMsg', ['class' => 'danger', 'msg' => '用户名或密码错误不能为空，请输入！']);
      return redirect(route('admin.login'));
    } else {

      // 验证账户名和密码
      $res = Auth::attempt(['username' => $request->username, 'password' => $request->password]);
      if ($res) {
        // 密码正确 验证账号状态 如果异常 直接报错返回 正常就进入admin.index首页
        if (Auth::user()->status  != 1) {
          session()->flash('arrMsg', ['class' => 'danger', 'msg' => '账户状态异常,请联系网站管理员处理！']);
          // 退出账号
          Auth::logout();
          return redirect(route('admin.login'));
        }
        return redirect(route('admin.index'));
      } else {
        session()->flash('arrMsg', ['class' => 'danger', 'msg' => '用户名或密码错误,请重试！']);
        return redirect(route('admin.login'));
      }
    }
  }

  // 退出登陆
  public function loginOut()
  {
    Auth::logout();
    return redirect(route('admin.login'));
  }
}
