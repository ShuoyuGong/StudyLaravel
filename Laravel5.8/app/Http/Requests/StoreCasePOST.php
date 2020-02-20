<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCasePOST extends FormRequest
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
      'title'         =>        'required|max:30',
      'abstract'      =>        'required|max:100',
      'picture'       =>        'required|image',
      'sort'          =>        'required|integer',

    ];
  }

  /**
   * 自定义不符合规则的返回信息
   */
  public function messages()
  {
    return [
      'title.required'              =>          '案例名称为必填信息,不能为空',
      'abstract.required'           =>          '案例摘要为必填信息,不能为空',
      'picture.required'            =>          '案例图片为必填信息,不能为空',
      'sort.required'               =>          '案例排序为必填信息,不能为空',
      'title.max'                   =>          '案例名称最长字符长度为30,请重新编写',
      'abstract.max'                =>          '案例摘要最长字符长度为30,请重新编写',
      'picture.image'               =>          '案例图片格式必须为jpeg/png/bmp/gif/svg',
      'sort.integer'                =>          '案例排序必须为正整数',
    ];
  }
}
