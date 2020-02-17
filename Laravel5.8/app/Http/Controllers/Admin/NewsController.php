<?php

namespace App\Http\Controllers\Admin;

// 引入数据模型
use App\Model\Admin\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
    $NewsModel = new News;
    $data = $NewsModel::orderBy('created_at', 'desc')->paginate(5);
    return view('admin.news.indexNews')->with('data', $data);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admin.news.createNews');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //处理添加的数据
    $NewsModel = new News;
    $NewsModel->title = $request->title;
    $NewsModel->keyWord = $request->keyWord;
    $NewsModel->views = $request->views;
    $NewsModel->describe = $request->describe;
    $NewsModel->abstract = $request->abstract;
    $NewsModel->content = $request->content;
    if ($request->file('picture')) {
      $NewsModel->picture = $request->file('picture')->store('news');
    }
    if ($NewsModel->save()) {
      session()->flash('arrMsg', ['class' => 'success', 'msg' => '保存成功']);
    } else {
      session()->flash('arrMsg', ['class' => 'danger', 'msg' => '保存失败']);
    }
    return redirect(route('admin.news.index'));
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\News  $news
   * @return \Illuminate\Http\Response
   */
  public function show(News $news)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\News  $news
   * @return \Illuminate\Http\Response
   */
  public function edit(News $news)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\News  $news
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, News $news)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\News  $news
   * @return \Illuminate\Http\Response
   */
  public function destroy(News $news)
  {
    //
  }
}
