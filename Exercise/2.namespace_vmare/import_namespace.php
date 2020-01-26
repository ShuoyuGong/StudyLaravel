<?php

// 导入
// 假如我们要经常在这个文件中使用 namespace.php中的one空间下的obj类

// 关键字引入
include 'namespace.php';

// use \one\obj;
// 引入之后起别名
use \one\obj as oobj;

// $Obj = new obj;
$Obj = new oobj;
var_dump($Obj->index());
