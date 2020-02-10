<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form action="/form" method="post">
    USER:<input type="text" name="username">
                  <br>
    PASS:<input type="text" name="password">
                  <br>
    <button>提交</button>
    {{csrf_field()}}
  </form>
</body>
</html>