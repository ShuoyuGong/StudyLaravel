<?php
// 命名空间使用的演示
namespace one;

class obj
{
  public function index()
  {
    echo "我是one空间下的obj类";
  }
}

namespace one\two;

class obj
{
  public function index()
  {
    echo "我是two空间下的obj类";
  }
}

namespace one\two\three;

class obj
{
  public function index()
  {
    echo "我是three空间下的obj类";
  }
}
