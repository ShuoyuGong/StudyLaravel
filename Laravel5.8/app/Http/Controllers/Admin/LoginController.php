<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;
// 引入类 用于限制登陆次数
use Str;

class LoginController extends Controller
{
  use ThrottlesLogins;
  public $username = 'username';
  public $maxAttempts = 5;
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
    /**
     * 验证登陆次数
     */
    if ($this->hasTooManyLoginAttempts($request)) {
      session()->flash('arrMsg', ['class' => 'danger', 'msg' => '错误次数超过5次！请五分钟后重试！']);
      return redirect()->back();
    }

    /**
     * 表单验证 用户名密码验证不能为空 验证码必须正确
     */
    $this->validate($request, [
      'username'  =>    'required',
      'password'  =>    'required',
      'captcha'   =>    'required|captcha',
    ], [
      'username.required'     =>    '用户名不能为空',
      'password.required'     =>    '密码不能为空',
      'captcha.required'      =>    '验证不能为空',
      'captcha.captcha'       =>    '验证码错误',
    ]);
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
      $this->incrementLoginAttempts($request);
      return redirect(route('admin.login'));
    }
  }

  // 退出登陆
  public function loginOut()
  {
    Auth::logout();
    return redirect(route('admin.login'));
  }

  /**
   * 登陆次数限制
   */

  protected function username()
  {

    return property_exists($this, 'username') ? $this->username : 'email';
  }
  protected function throttleKey(Request $request)
  {
    return Str::lower('admin.' . $request->input($this->username())) . '|' . $request->ip();
  }
}
