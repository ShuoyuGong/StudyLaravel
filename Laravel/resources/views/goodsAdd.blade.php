<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>商品的添加</h1>
  <form action="/goods/select" method="post">
    <input type="text" name="goodsName"><br>
    {{csrf_field()}}
    <button>添加</button>
  </form>
  

</body>
</html>