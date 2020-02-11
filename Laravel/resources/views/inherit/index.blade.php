<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title','index')</title>
</head>

<body>
  <div style="height:100px; background:#123456"></div>
  @section('contend')
  <div style="height:400px; background:#aefcdb"></div>
  @show

  @section('footer')
  <div style="height:100px; background:#781234"></div>
  @show
</body>
@section('js')
@show

</html>