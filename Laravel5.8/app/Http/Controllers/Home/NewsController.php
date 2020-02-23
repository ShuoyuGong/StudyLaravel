<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Banner;
use App\Model\Admin\News;

class NewsController extends Controller
{
  protected $banner;
  // 获取新闻banner
  public function __construct()
  {
    $banner = Banner::where('entitle', 'NewsBanner')->first();
    //将数组中的第0个提取到 $this->banner
    $this->banner = $banner->bannerItem[0];
  }
  // 获取新闻列表，并渲染到列表首页
  public function getNewsList()
  {
    // 获取新闻banner

    $news_list = News::OrderBy('created_at', 'Desc')->OrderBy('id', 'Desc')->paginate(6);
    return view('home.news.index')->with('news_list', $news_list)->with('banner', $this->banner);
  }

  // 获取新闻详情 并渲染到新闻列表详情页
  public function getNewsDetail(News $newsDetail)
  {
    News::where('id', $newsDetail->id)->increment('views', 1);
    return view('home.news.newsDetail')->with('newsDetail', $newsDetail)->with('banner', $this->banner);
  }
}
