@extends('home.default')
@section('title','新闻列表')
@section('content')
<!-- banner部分 -->
<div class="banner product" style="background: url('/uploads/{{isset($banners->pic)?$banners->pic:""}}') no-repeat center top;background-size: cover;">
    <div class="title">
        <p>{{isset($banners->title)?$banners->title:""}}</p>
        <p class="en">{{isset($banners->digest)?$banners->digest:""}}</p>
    </div>
</div>
<!-- main -->
<div class="main-news">
    <div class="layui-container">
        <div class="layui-row layui-col-space20">
            @foreach($list as $v)
            <div class="layui-col-lg6 content">
                <div>
                    <div class="news-img"><a href="{{route('index.news.show',['news'=>$v->id])}}"><img src="/uploads/{{$v->pic}}"></a></div><div class="news-panel">
                        <strong><a href="{{route('index.news.show',['news'=>$v->id])}}">{{$v->title}}</a></strong>
                        <p class="detail"><span>{{$v->remark}}</span><a href="{{route('index.news.show',['news'=>$v->id])}}">[详细]</a></p>
                        <p class="read-push">阅读 <span>{{$v->views}}</span>&nbsp;&nbsp;&nbsp;&nbsp;发布时间：<span>{{$v->created_at}}</span></p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div id="newsPage">{{$list->links('vendor.pagination.default')}}</div>
        {{--<div id="newsPage"></div>--}}
    </div>
</div>
@endsection
@section('myjs')
    <script>
        {{--layui.use('laypage', function(){--}}
            {{--var laypage = layui.laypage;--}}
            {{--//执行一个laypage实例--}}
            {{--laypage.render({--}}
                {{--elem: 'newsPage' //注意，这里的 test1 是 ID，不用加 # 号--}}
                {{--,count: {{$list->total()}} //数据总数，从服务端得到--}}
                {{--,curr: {{$list->currentPage()}}--}}
                {{--,jump: function(obj, first){--}}
                    {{--//首次不执行--}}
                    {{--if(!first){--}}
                        {{--location.href = "?page="+obj.curr;--}}
                    {{--}--}}
                {{--}--}}
            {{--});--}}
        {{--});--}}
    </script>
@endsection