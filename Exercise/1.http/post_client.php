<?php
// 创建连接
$fp = fsockopen("localhost", 80, $errno, $errstr, 10);
// 判断
if (!$fp) {
  echo $errstr;
  die;
}

$http = "";
// 请求行
$http .= "POST /StudyLaravel/StudyLavarel/1.http/3server.php HTTP/1.1\r\n";
// 请求头
$http .= "Host: localhost\r\n";
$http .= "Connection: close\r\n";
$http .= "Cookie: username=admin;uid=200\r\n";
$http .= "User-agent: firefox-chrome-safari-ios-android\r\n";
$http .= "Content-type: application/x-www-form-urlencoded\r\n";
$http .= "Content-length: 37\r\n\r\n";

// 请求体
$http .= "email=xiaohigh@163.com&username=admin\r\n";


// 发送
fwrite($fp, $http);


// 获取结果
$res = "";
while (!feof($fp)) {
  $res .= fgets($fp);
}

echo $res;
