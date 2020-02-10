<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form action="/upload" method="post" enctype="multipart/form-data">
    <span>头像</span>
    <input type="file" name="proFile">
    <br>
    <button>上传</button>
    {{csrf_field()}}
  </form>
</body>
</html>