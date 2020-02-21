<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerClassificationPOST extends FormRequest
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
      'title'           =>        'required|max:50',
      'entitle'         =>        'required|max:150',
    ];
  }


  /**
   * 不符合规则返回的信息
   */
  public function messages()
  {
    return [
      'title.required'        =>        '分类名称为必填字段，不能为空',
      'entitle.required'      =>        '英文分类名称为必填字段，不能为空',
      'title.max'             =>        '分类名称最大字符长度为50',
      'entitle.max'           =>        '英文分类名称最大字符长度为150',
    ];
  }
}
