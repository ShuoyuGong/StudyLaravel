<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
  $a = "我是GSY";
  return $a;
  // return view('welcome');
});

Route::get('/test', function(){
  echo "这是一个测试路径";
});

Route::get('/admin/user', function(){
  echo "这是后台管理界面";
});

Route::post('/add',function(){
  // echo "这是一个添加操作";
  $username = $_POST["username"];
  $password = $_POST["pwd"];
  echo "用户名是：".$username."<br>"."密码是：".$password;
});

Route::get('/form',function(){
  // echo "这是一个添加操作";
  return view('form');
});

