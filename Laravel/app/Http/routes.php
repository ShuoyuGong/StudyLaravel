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

// 模拟put请求
Route::get('/put',function(){
  return view('put');
});

Route::put('/update',function(){
  $username = $_POST["username"];
  $password = $_POST["pwd"];
  echo "用户名是：".$username."<br>"."密码是：".$password;
});

// 带参数的路由
Route::get('/article/{id}',function($id){
  echo "ID值为".$id;
});

// 限制参数的类型
Route::get('/goods/{id}',function($id){
  echo "商品的ID为".$id;
})->where('id','\d+');

// 传递多个参数
Route::get('/values/{type}-{id}',function($type,$id){
  echo "商品的类型为".$type."商品ID为".$id;
})->where('id','\d+');