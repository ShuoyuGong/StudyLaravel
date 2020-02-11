<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <style>
    table,td{
      border-collapse:collapse;
    }
    td{
      padding:10px;
    }
  </style>
</head>
<body>
  <h1>个人自我介绍</h1>
  <table>
    <tr>
        <td>名字</td>
        <td>{{$info['name']}}</td>
    </tr>
    <tr>
        <td>年龄</td>
        <td>{{$info['age']}}</td>
    </tr>
    <tr>
        <td>地址</td>
        <td>{{$info['address']}}</td>
    </tr>
  </table>
</body>
</html>