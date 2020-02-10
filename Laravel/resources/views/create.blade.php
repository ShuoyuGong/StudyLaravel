<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>文章的创建 POST方式访问ArticleController控制器store方法</h1>
  <form action="/article" method="post">
    <input type="text" name="goodsName"><br>
    {{csrf_field()}}
    <button>创建</button>
  </form>

  <h1>文章的创建 PUT方式访问ArticleController控制器update方法</h1>
  <form action="/article/20" method="post">
    <input type="text" name="goodsName"><br>
    <input type="hidden" name="_method" value="PUT">
    {{csrf_field()}}
    <button>创建</button>
  </form>


  <h1>文章的创建 DELETE方式访问ArticleController控制器destroy方法</h1>
  <form action="/article/20" method="post">
    <input type="text" name="goodsName"><br>
    <input type="hidden" name="_method" value="DELETE">
    {{csrf_field()}}
    <button>创建</button>
  </form>
</body>
</html>