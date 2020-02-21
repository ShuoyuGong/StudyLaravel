<?php


/**
 * 检查返回的布尔值
 */
function checkRes($blur = false, $msg = '操作')
{
  if ($blur) {
    session()->flash('arrMsg', ['class' => 'success', 'msg' => $msg . '成功']);
  } else {
    session()->flash('arrMsg', ['class' => 'danger', 'msg' => $msg . '失败']);
  }
}


/**
 * 没有图片返回arrMsg
 */
function noPicture($info)
{
  return session()->flash('arrMsg', ['class' => 'danger', 'msg' => $info . '失败,请上传图片']);
}
