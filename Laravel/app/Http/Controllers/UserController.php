<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //用户添加
    public function show(){
      return 'I Love You';
    }

    //用户更改
    public function update($id){
      // 
      return '用户更改 ID为'.$id;
    }

    //用户删除
    public function delete($id){
      // 
      // return '用户删除 ID为'.$id;
      // 通过别名创建url
      echo route('Udelete',['id'=>$id]);
    }

    
    //用户升级
    public function shengji(){
      return '用户升级';
    }

    //用户禁用
    public function jinyong(){
      return '用户禁用';
    }


    // // *********************************第七节*Laravel基础之请求****************************
    public function qingqiu(Request $request)
    {
      // /////////////基本信息获取
      // 请求方法获取
      // $res = $request->method();

      // 请求参数检测
      // $res = $request->isMethod('get');

      // 请求路径获取
      // $res = $request->path();

      // 获取完整的url
      // $res = $request->url();

      // 获取ip
      // $res  = $request->ip();

      // 获取端口号
      $res = $request->getPort();
      // var_dump($res);

      // /////////////提取请求参数
      $username = $request->input('username');

      // 设置默认值
      // $passWord = $request->input('password','123456');
      // echo $passWord;

      // 检测是否存在
      $res = $request->has('password');
      // var_dump($res);

      // 提取所有参数
      $res = $request->all();

      // 提取部分参数
      $res = $request->only(['username','password']);
      $res = $request->except('username');

      // 获取头信息
      $res = $request->header('Cookie');
      var_dump($res);
    }

    public function form()
    {
      return view('user');
    }

    public function insert(Request $request)
    {
      $userName = $request->input('username');
      $passWord = $request->input('password');
      var_dump($userName.'...'.$passWord);
    }

    public function filesShow()
    {
      return view('filesUpload');
    }

    public function filesUpload(Request $request)
    {
      // 获取文件是否上传
      if($request->hasFile('proFile')){
        $request->file('proFile')->move('upload','tupian.jpg');
        // echo $res;
      }else{
        echo '没有上传图片';
      }
    }

    public function cookie(Request $request)
    {
      // 写入cookie
      // 静态成员方法
      // \Cookie::queue('name','gsy',20);
      // return response('')->withCookie('username','kjdashgak',30);

      // 读取cookie
      // $res = \Cookie::get('username');
      $res = $request->cookie('username');
      var_dump($res);
    }

    public function showFlash()
    {
      return view('flash');
    }

    public function doFlash(Request $request)
    {
      // var_dump($request->all());
      // 闪存数据
      // 将所有请求参数写入闪存中
      $request->flash();
      return back();
    }

    public function old()
    {
      var_dump(old('password'));
    }

    public function sessionFlash()
    {
      // 手动自定义闪存
      \Session::flash('name','gsy');
    }

    public function readFlash()
    {
      echo session('name');
    }
}
