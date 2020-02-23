<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyProfilePOST extends FormRequest
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
      'type'       =>       'integer|max:3',
      'title'      =>       'required|max:50',
      'describe'   =>       'sometimes|required|max:150',
      'picture'    =>       'sometimes|required|image',
      'detail'     =>       'sometimes|required|max:150',
    ];
  }

  /**
   * 当验证规则不通过时返回提示信息
   */
  public function messages()
  {
    return [
      'type.required'            =>      '类型为必填项，不能为空',
      'title.required'           =>      '标题为必填项，不能为空',
      'describe.required'        =>      '描述为必填项，不能为空',
      'picture.required'         =>      '图片为必填项，不能为空',
      'detail.required'          =>      '详情为必填项，不能为空',
      'type.integer'             =>      '类型必须为正整数',
      'type.max'                 =>      '类型值应在1-3之间',
      'title.max'                =>      '标题最大字符长度为50',
      'describe.max'             =>      '描述最大字符长度为150',
      'picture.image'            =>      '图片格式必须为jpeg/png/bmp/gif/svg',
      'detail.max'               =>      '详情最大字符长度为150',
    ];
  }
}
