<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ToolsController extends Controller
{
  //Editor编辑器图片上传接口
  public function imgUploadTools(Request $request)
  {
    $res = [
      'code' => 200,
      'url'   => '',
    ];
    if ($request->file('file')) {
      $res['url'] = "/fileUploads/" . $request->file('file')->store("news/editor");
    } else {
      $res['code'] = 400;
    }
    return $res;
  }
}
