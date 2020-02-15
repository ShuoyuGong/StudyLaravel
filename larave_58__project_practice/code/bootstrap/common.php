<?php
/**
 * Created by PhpStorm.
 * User: YiFeng
 * Date: 2019/3/28
 * Time: 14:19
 */
function checkreturn($blur=false,$msg="操作"){
    if($blur){
        session()->flash("data",['class'=>'success','msg'=>$msg."成功"]);
    }else{
        session()->flash("data",['class'=>'dnager','msg'=>$msg."失败"]);
    }
}