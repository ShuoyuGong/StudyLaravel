@extends('home.default')
@section('title','产品列表')
@section('content')
<!-- banner部分 -->
<div class="banner product" style="background: url('/uploads/{{isset($banners->pic)?$banners->pic:""}}') no-repeat center top;background-size: cover;">
    <div class="title">
        <p>{{isset($banners->title)?$banners->title:""}}</p>
        <p class="en">{{isset($banners->digest)?$banners->digest:""}}</p>
    </div>
</div>
<!-- main部分 -->
<div class="main product">
    <div class="layui-container">
       @foreach($list as $v)
        <div class="content layui-row">
            <div class="layui-col-xs12 layui-col-sm6 layui-col-md7 layui-col-lg6 content-img"><img src="/uploads/{{$v->pic}}"></div>
            <div class="layui-col-xs12 layui-col-sm6 layui-col-md5 layui-col-lg6 right">
                <p class="label">{{$v->title}}</p>
                <p class="detail">{{$v->remark}}</p>
                <div><a href="{{route('index.product.show',['prduct'=>$v->id])}}">查看产品 ></a></div>
            </div>
        </div>
       @endforeach
    </div>
</div>
@endsection