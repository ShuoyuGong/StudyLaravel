<?php

namespace App\Http\Controllers\Admin;

// 引入数据模型
use App\Model\Admin\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewsPost;
use Storage;

class NewsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $NewsModel = new News;
    $data = $NewsModel::paginate(15);
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
  public function store(StoreNewsPost $request)
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
    checkRes($NewsModel->save(), '保存');
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
    //返回编辑模版
    return view('admin.news.editNews')->with('editNewsData', $news);
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
    //将更新数据写入数据库
    $data = [
      'title'           =>    $request->title,
      'keyWord'         =>    $request->keyWord,
      'describe'        =>    $request->describe,
      'abstract'        =>    $request->abstract,
      'views'           =>    $request->views,
      'content'         =>    $request->content,
      'created_at'      =>    date('Y-m-d H:i:s'),
      'updated_at'      =>    date('Y-m-d H:i:s'),
    ];
    if ($request->file('picture')) {
      $data['picture'] = $request->file('picture')->store('news');
      // 删除旧图片
      Storage::delete($news->picture);
    }
    $NewsModel = new News;
    $res = $NewsModel::where('id', '=', $news->id)->update($data);
    checkRes($res > 0, '编辑');
    return redirect(route('admin.news.index'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\News  $news
   * @return \Illuminate\Http\Response
   */
  public function destroy(News $news)
  {
    //根据ID删除数据
    $res = $news->delete();
    checkRes($res, '删除');
    Storage::delete($news->picture);
    return redirect(route('admin.news.index'));
  }
}
