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
use Illuminate\Http\Request;

Route::name("index.")->middleware('spider')->group(function() {
    Route::get('/','Home\IndexController@index')->name("home");
    Route::get('/product','Home\ProductController@index')->name("product.list");
    Route::get('/productshow/{product}','Home\ProductController@show')->name("product.show");
    Route::get('/news','Home\NewsController@index')->name("news.list");
    Route::get('/news/{news}','Home\NewsController@show')->name("news.show");
    Route::get('/cases','Home\CasesController@index')->name("cases.list");
    Route::get('/abount','Home\PageController@index')->name("page.index");
});
//后台路由
Route::prefix("admin")->name("admin.")->middleware('auth')->group(function(){
    Route::get("/","Admin\IndexController@index")->name("home");
    Route::get("/index","Admin\IndexController@index")->name("home");
    Route::group(['prefix'=>'config'],function(){
        Route::get("/site","Admin\ConfigController@siteconfig")->name("config.siteconfig");
        Route::get("/information","Admin\ConfigController@information")->name("config.information");
        Route::get("/baidu","Admin\ConfigController@baidu")->name("config.baidu");
        Route::post("/store","Admin\ConfigController@store")->name("config.store");
    });
    //新闻
    Route::resource("/news","Admin\NewsController")->except(['destroy','create']);
    Route::get('admin/news/add','Admin\NewsController@create')->name('news.create');
    Route::get('admin/news/{news}/del','Admin\NewsController@destroy')->name("news.delete");
    Route::get('admin/news/baidusend/{news}','Admin\NewsController@baidusend')->name("news.baidusend");

    //产品分类
    Route::group(['prefix'=>'category'],function(){
        Route::get("/","Admin\CategoryController@index")->name("category.list");
        Route::match(['get','post'],"/create","Admin\CategoryController@create")->name("category.create");
        Route::match(['get','post'],"/edit/{category}","Admin\CategoryController@edit")->name("category.edit");
        Route::get("/delete/{cate}","Admin\CategoryController@destory")->name("category.delete");
    });
    Route::resource("/product","Admin\ProductController");
    Route::resource("/cases","Admin\CaseController");
    Route::get("/page/createzx","Admin\PageController@createzx")->name('page.createzx');
    Route::get("/page/licheng","Admin\PageController@licheng")->name('page.licheng');
    Route::get("/page/createlc","Admin\PageController@createlc")->name('page.createlc');
    Route::get("/page/editlc/{page}","Admin\PageController@editlc")->name('page.editlc');
    Route::get("/page/jianjie","Admin\PageController@create")->name('page.create');
    Route::resource("/page","Admin\PageController")->except("create");
    Route::resource("/banner","Admin\BannerController");
    Route::post('/banneritem/setsort',"Admin\BanneritemController@setsort")->name('banneritem.setsort');
    Route::resource("/banneritem","Admin\BanneritemController");
    Route::resource("/friend","Admin\FriendController");
    //登录
    Route::get('/logout','Admin\LoginController@logout')->name('login.logout');
    //图片上传
    Route::post('upload','Admin\IndexController@imgupload')->name("upload");
});
Route::get('/admin/login','Admin\LoginController@login')->name('admin.login.login');
Route::post('/admin/dologin','Admin\LoginController@dologin')->name('admin.login.dologin');
