<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>add</title>
</head>
<body>
  <form action="/add" method = "post">
    用户名:<input type="text" name="username"><br>
    密码：<input type="password" name = "pwd"><br>
    <button style = "width:100px">提交</button>
    {{csrf_field()}}
  </form>
</body>
</html>