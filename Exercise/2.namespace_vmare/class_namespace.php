<?php

namespace one;

// 变量特征
class Man
{
}

// 声明一个字符串 如果使用动态来实例化对象的话

//在这里一般使用单引号，因为双引号可以解析转义字符 例 $str = "\two\Man";
$str = '\one\Man';
$me = new $str;

var_dump($str);
