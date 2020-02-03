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

// 路由别名
Route::get('/otherName',[
    'as'=>'on',
    'uses'=>function(){
      echo "这是路由别名".route('on'); //route是一个函数，通过路由别名来快速创建完整的url
    }
]);

// 路由组的设置
Route::group([],function(){
  // 将路由设置放在路由组中，例如前台路由组，后台路由组，可以为每一个路由组设置不通的权限以及方法
});

// 404页面设置
Route::get('/404',function(){
  abort(404);
});

// 用户登陆页面展示
Route::get('/login',function(){
  echo '这是用户的登陆界面';
});

// 设置页面
Route::get('/setting',[
  'middleware' => 'login',
  'uses' => function(){
    echo '这是网站的设置界面';
  }
]);