<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FriendshipLinksPOST extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'title'     =>     'required|max:50',
      'url'       =>     'required|max:200|url',
      'sort'      =>     'required|integer',
      'alt'       =>     'required|max:30',
    ];
  }

  /***
   * 不符合验证规则返回的提示信息
   */
  public function messages()
  {
    return [
      'title.required'          =>           '标题为必填字段，不能为空',
      'url.required'            =>           'URL地址为必填字段，不能为空',
      'sort.required'           =>           '排序为必填字段，不能为空',
      'alt.required'            =>           '鼠标悬浮显示文本为必填字段，不能为空',
      'title.max'               =>           '标题最长字符为50个',
      'url.max'                 =>           'URL地址最长字符为200个',
      'url.url'                 =>           '必须为正确的URL网址,例如:Http://www.baidu.com',
      'sort.max'                =>           '排序必须为整数',
      'alt.max'                 =>           '鼠标悬浮提示文本最长字符为30个',


    ];
  }
}
