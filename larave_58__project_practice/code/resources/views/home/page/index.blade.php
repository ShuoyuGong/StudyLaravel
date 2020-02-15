@extends('home.default')
@section('title',"关于我们")
@section('content')
    <!-- banner部分 -->
    <div class="banner news" style="background: url('/uploads/{{isset($banners->pic)?$banners->pic:""}}') no-repeat center top;background-size: cover;">
        <div class="title">
            <p>{{isset($banners->title)?$banners->title:""}}</p>
            <p class="en">{{isset($banners->digest)?$banners->digest:""}}</p>
        </div>
    </div>
<!-- main部分 -->
<div class="main-about">
    <div class="layui-container">
        <div class="layui-row">
            <ul class="aboutab">
                <li class="layui-this">公司简介</li><li>招贤纳士</li><li>发展历程</li>
            </ul>
            <div class="tabIntro">
                {!! $jianjie->content !!}
            </div>
            <div class="tabJob">
                @foreach($zxns as $v)
                <div class="content">
                    <p class="title">{{$v->title}}</p>
                    <p>> 职位描述</p>
                    <div class="myjob">
                        {!! $v->content !!}
                    </div>
                </div>
                @endforeach
            </div>
            <div class="tabCour">
                <p class="title">我们的蜕变</p>
                <ul class="timeline">
                    @foreach($licheng as $k=>$l)
                    <li class="{{($k%2)?'odd':''}}">
                        <div class="cour-img"><img src="/uploads/{{$l->pic}}"></div>
                        <div class="cour-panel layui-col-sm4 layui-col-lg5 {{($k%2)?'':'layui-col-sm-offset8  layui-col-lg-offset7'}}">
                            <p class="label">{{$l->title}}</p>
                            <p>{{$l->remark}}</p>
                        </div>
                    </li>
                    @endforeach
                    <li class="odd">
                        <div class="cour-img"><img src="{{ asset(__INDEX__) }}/res/static/img/us_img8.png"></div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection