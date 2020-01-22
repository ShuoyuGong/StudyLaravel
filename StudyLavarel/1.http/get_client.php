<?php
// 创建连接
$fp = fsockopen("localhost", 80, $errno, $errstr, 10);
// 检测
if (!$fp) {
  echo $errstr;
  die;
}
// 拼接http请求报文
$http = "";
// 请求报文包括三个部分 请求行 请求头 请求体
// 请求头包括三部分 请求方式 请求脚本的绝对路径 请求版本
// $http .= "GET /StudyLaravel/StudyLavarel/1.http/server.php HTTP/1.1\r\n";
// 使用地址栏url带参数方式传参
$http .= "GET /StudyLaravel/StudyLavarel/1.http/server.php?username=gsy&pwd=123456 HTTP/1.1\r\n";
// 请求头信息
$http .= "Host: localhost\r\n";
$http .= "Connection: close\r\n\r\n";

// 请求体 无

// 发送请求
fwrite($fp, $http);

$res = "";
// 获取结果
while (!feof($fp)) {
  $res .= fgets($fp);
}

// 输出
echo $res;
