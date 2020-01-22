<?php
// 引入namespace文件
include 'namespace.php';

// 实例化对象 绝对路径
$obj = new \one\obj;
$obj = new \one\two\obj;
$obj = new \one\two\three\obj;

// 直接实例化，如果当前代码的空间跟类文件的空间是一致的话，可以直接实例化 非限定名称
// 相对路径
$obj = new one\two\three\obj;
var_dump($obj->index());
