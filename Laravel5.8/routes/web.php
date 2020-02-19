<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// use Illuminate\Routing\Route;
// 引入Request类
use Illuminate\Http\Request;
// 引入Route类
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//   return view('welcome');
// });

// Route::get('/testIndex', 'TestController@index');

// Route::redirect('/abc', 'http://www.baidu.com', 301)->name('baidu');

// Route::get('makeUrl', function () {
//   echo url("testIndex");
// });

// // 视图路由
// Route::view('/index', 'welcome');

// // 路由参数
// Route::get('/user/{id?}', function ($id = null) {
//   dd($id);
// })->where('id', '[0-9]*');

// // 路由参数全局约束
// Route::get('/user/all/{id}/{aid}', function (Request $request, $id = null, $aid) {
//   dump($aid);
//   dump(request()->id);
//   dump(request()->aid);
//   dd($request->id);
// });


// ******************后台路由组*********************************
// Route::prefix('admin')->name('admin.')->group(function () {
// 路由前缀
// // 登陆
// Route::get('login/{age}', function (Request $request) {
//   dump($request->age);
//   return '后台登陆';
// })->middleware('CheckAge');

// // 会员信息
// Route::get('userInfo', function () {
//   return '会员信息';
// });
// Route::get('testIndex', 'Admin\TestController@index');


// 后台首页
// Route::get('admin', 'Admin\IndexController@index');
// });

// Route::get('/home', function () {
//   return "中间件没有通过！3秒后跳转至首页
//   <script>
//     setTimeout(function(){
//       window.location.href='/';
//     }, 3000)
//   </script>";
// });



Route::get('/', function () {
  return view('welcome');
});

// ****************************************后台路由组**********************************************
Route::prefix('admin')->name('admin.')->group(function () {
  // 后台首页显示
  Route::get('/index', function () {
    return view('admin/index/index');
  })->name('index');

  // ***********配置路由组************
  Route::group(['prefix' => 'config'], function () {
    Route::get('/setConfig', 'Admin\ConfigController@setConfig')->name('config.setConfig');
    // 数据入库
    Route::post('/store', 'Admin\ConfigController@store')->name('config.store');
    // 基本信息配置界面
    Route::get('/informationConfig', 'Admin\ConfigController@informationConfig')->name('config.informationConfig');
    // 百度推送设置
    Route::get('/baiduConfig', 'Admin\ConfigController@baiduConfig')->name('config.baiduConfig');
  });

  // *********新闻模块**********
  Route::resource('/news', 'Admin\NewsController')->except('destroy');
  // 删除数据
  Route::get('/admin/news/{news}/del', 'Admin\NewsController@destroy')->name('news.delete');
  // editor图片上传接口
  Route::post('/imgUpload', 'Admin\ToolsController@imgUploadTools')->name('imgUploadTools');

  // ***********产品分类**************
  Route::group(['prefix' => 'category'], function () {
    // 分类列表 页面显示
    Route::get('/index', 'Admin\CategoryController@index')->name('category.index');
    // 添加分类 页面显示
    Route::match(['get', 'post'], '/create', 'Admin\CategoryController@create')->name('category.create');
    // 编辑分类
    Route::match(['get', 'post'], '/edit/{cateID}', 'Admin\CategoryController@edit')->name('category.edit');
    // 删除分类
    Route::get('/destroy/{cateID}', 'Admin\CategoryController@destroy')->name('category.destroy');
  });
  // 产品管理----资源控制器
  Route::resource('/product', 'Admin\ProductController');
  // 产品管理首页删除功能
  // Route::get('/destroy/{productId}', 'Admin\ProductController@destroy')->name('product.destroy');
});
