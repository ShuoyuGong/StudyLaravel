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







// 网站首页直接显示
Route::get('/', 'Home\IndexController@index')->name('/');

// ****************************************前台路由组**********************************************
Route::prefix('home')->name('home.')->group(function () {
  // 产品页面展示
  Route::get('/product', 'Home\ProductController@index')->name('product');
  // 产品详情页面的展示
  Route::get('/productDetail/{productDetailID}', 'Home\ProductController@showProductDetail')->name('productDetail');

  // 新闻页面展示
  Route::get('/news', 'Home\NewsController@getNewsList')->name('news');
  // 新闻详情页面的展示
  Route::get('/newsDetail/{newsDetail}', 'Home\NewsController@getNewsDetail')->name('newsDetail');

  // 案例界面的展示
  Route::get('/case', 'Home\CaseController@getCaseList')->name('case');

  // 关于我们 页面的展示
  Route::get('/aboutUs', 'Home\AboutUsController@getAboutUsList')->name('aboutUs');
});





// 登陆界面的展示
Route::get('/admin', 'Admin\LoginController@index')->name("admin.login");
// 退出登陆状态
Route::get('/admin/login/loginOut', 'Admin\LoginController@loginOut')->name('admin.login.loginOut');
// 处理登陆表单数据***********************************
Route::post('/login/doLogin', 'Admin\LoginController@doLogin')->name('admin.login.doLogin');

// ****************************************后台路由组**********************************************
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

  // 后台首页显示***************************************
  Route::get('/index', function () {
    if (Auth::check()) {
      return view('admin/index/index');
    } else {
      return "请先登陆";
    }
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
  // 案例管理----资源控制器
  Route::resource('/cases', 'Admin\CaseController');

  // 公司简介管理----资源控制器*******************************************
  // 加载 添加招聘信息 页面
  Route::get('/companyProfile/createRecruit', 'Admin\CompanyProfileController@createRecruit')->name('companyProfile.createRecruit');
  // 加载 发展历程 页面
  Route::get('/companyProfile/developmentHistory', 'Admin\CompanyProfileController@developmentHistory')->name('companyProfile.developmentHistory');
  // 加载 添加发展历程信息 页面
  Route::get('/companyProfile/createDevelopmentHistory', 'Admin\CompanyProfileController@createDevelopmentHistory')->name('companyProfile.createDevelopmentHistory');
  // 加载 编辑发展信息历程 页面
  Route::get('/companyProfile/editDevelopmentHistory/{companyProfile}', 'Admin\CompanyProfileController@editDevelopmentHistory')->name('companyProfile.editDevelopmentHistor');
  Route::resource('/companyProfile', 'Admin\CompanyProfileController')->except('show');

  //轮播图分类 管理--资源控制器******************************************
  Route::resource('/bannerClassification', 'Admin\BannerClassificationController');
  //轮播图列表 管理--资源控制器******************************************
  Route::resource('/bannerItem', 'Admin\BannerItemController');
  // jquery ajax 异步排序
  Route::post('/bannerItem/setSort', 'Admin\BannerItemController@setSort')->name('bannerItem.setSort');

  // 友情链接 -- 资源控制器**********************************************
  Route::resource('friendshipLinks', 'Admin\FriendshipLinksController');
  // jquery ajax 异步排序
  Route::post('/friendshipLinks/setSort', 'Admin\FriendshipLinksController@setSort')->name('friendshipLinks.setSort');
});
