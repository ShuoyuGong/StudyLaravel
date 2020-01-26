<?php
// 创建连接
$fp = fsockopen('gwgp-n6uzuwmjrou.n.bdcloudapi.com', 80, $errno, $errstr, 10);

if (!$fp) {
  echo $errstr;
  die;
}

$http = "";
$http .= "GET /weather/query?city=北京 HTTP/1.1\r\n";


$http .= "Host: gwgp-n6uzuwmjrou.n.bdcloudapi.com\r\n";
$http .= "Connection: close\r\n";
$http .= "X-Bce-Signature:AppCode/ef6ef7f2d9e546929ac1bbd8bc23c216\r\n\r\n";

// fwrite()用于把$http写到$fp里面 
fwrite($fp, $http);

$res = "";
// feoof()用于检测$fp有没有执行完毕
while (!feof($fp)) {
  // fgets()用于获取1k数据的获取，并拼接给$res
  $res .= fgets($fp);
  // echo $fp;
}

print_r($res);
