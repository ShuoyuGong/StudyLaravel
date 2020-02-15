@extends('home.default')
@section('title',"新闻详情-".$news->title)
@section('keyword',"新闻详情-".$news->keyword)
@section('desc',"新闻详情-".$news->desc)
@section('content')
<!-- banner部分 -->
<div class="banner news" style="background: url('/uploads/{{isset($banners->pic)?$banners->pic:""}}') no-repeat center top;background-size: cover;">
    <div class="title">
        <p>{{isset($banners->title)?$banners->title:""}}</p>
        <p class="en">{{isset($banners->digest)?$banners->digest:""}}</p>
    </div>
</div>
<!-- main部分 -->
<div class="main-newsdate" style="margin-bottom: 15px;">
    <div class="layui-container" style="word-break: break-all;">
        <p class="news"><a href="news.html">产品展示</a> > 详情</p>
        <h1>{{$news->title}}</h1>
        <p class="pushtime">发布时间：<span>{{$news->created_at}}</span></p>
        <p class="introTop">{{$news->remark}}</p>
        <div style="text-align: left;">
            {!! $news->content !!}
        </div>
    </div>
</div>
@endsection