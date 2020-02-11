<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{$total}}</title>
</head>

<body>
  <!-- IF ELSE -->
  <h1>
    给你买一个
    @if ($total <= 100 && $total>= 90)
      MAC
      @elseif ($total < 90 && $total>= 60)
        DELL
        @else
        锤子
        @endif
  </h1>
  <hr>
  性别：
  <input type="radio" name="sex" value="1" @if($sex==1) checked @endif>男
  <input type="radio" name="sex" value="0" @if($sex==0) checked @endif>女


  <hr>

</body>


</html>