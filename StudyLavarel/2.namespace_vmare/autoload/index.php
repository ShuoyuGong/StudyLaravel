<?php

function __autoload($className)
{
  // 将反斜线替换成正斜线
  $class = str_replace('\\', '/', $className);
  // 拼接文件的路径
  $path = './' . $class . '.php';
  // 检测该路径文件是否存在
  if (file_exists($path)) {
    include $path;
  }
  // echo $path;
}
// 如果当前类的空间路径很文件所处的路径保持一致的话，很容易获取到当前文件的位置
$obj = new \Org\B;

var_dump($obj);
