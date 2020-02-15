@extends('home.default')
@section('title',"产品详情-".$product->title)
@section('content')
<!-- banner部分 -->
<div class="banner product" style="background: url('/uploads/{{isset($banners->pic)?$banners->pic:""}}') no-repeat center top;background-size: cover;">
    <div class="title">
        <p>{{isset($banners->title)?$banners->title:""}}</p>
        <p class="en">{{isset($banners->digest)?$banners->digest:""}}</p>
    </div>
</div>
<!-- main部分 -->
<div class="main-newsdate">
    <div class="layui-container">
        <p class="news"><a href="news.html">产品展示</a> > {{$product->category->name}}</p>
        <h1>{{$product->title}}</h1>
        <p class="pushtime">发布时间：<span>{{$product->created_at}}</span></p>
        <p class="introTop">{{$product->remark}}</p>
        {!! $product->content !!}
    </div>
</div>
@endsection