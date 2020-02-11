<html><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{$title}}</title>

  <style>
    #pages a{
      display:block;
      width:30px;
      height:30px;
      border:solid 1px #ddd;
      float:left;
      text-align:center;
      line-hieght:30px;
      margin-right:10px;
      color:skyblue;
    }
  </style>
</head>
<body>
  <h1>Blade</h1>
  <!-- 使用函数 -->
  <h2>当前时间：</h2>
  <span style='color:red;'>{{time()}}</span>
  <h2>格式化字符串：</h2>
  <span style='color:blue;'>{{date('Y-m-d H:i:s')}}</span>
  <h2>字符串截取：</h2>
  <span style='color:green;'>{{mb_substr($title,0)}}</span>

  <!-- 使用默认值 -->
  <h2>使用认值:</h2>
  <span style='color:greenyellow;'>{{$name or '宋雨涵'}}</span>

  <!--  html代码显示 -->
  <hr>
  <h2>分页页码:</h2>
  <span style='color:greenyellow;' id="pages">{!!$page!!}</span>
    
</body>
</html>