<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerItemPOST extends FormRequest
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
      'title'           =>        'required|max:60',
      'digest'          =>        'required|max:150',
      'sort'            =>        'required|integer',
      'isShow'          =>        'sometimes|integer',
      'BannerId'        =>        'required|integer',
      'picture'         =>        'sometimes|image',
    ];
  }

  /**
   * 不符合规则返回的提示信息
   */
  public function messages()
  {
    return [
      'title.required'              =>          '名称为必填字段，不能为空！',
      'digest.required'             =>          '摘要为必填字段，不能为空！',
      'sort.required'               =>          '排序为必填字段，不能为空！',
      'BannerId.required'           =>          '轮播图分类为必填字段，不能为空！如果没有选择，请先添加分类',
      // 'picture.required'            =>          '图片为必填项，必须上传！',
      'title.max'                   =>          '名称最大长度为60！',
      'digest.max'                 =>           '摘要最大长度为150！',
      'sort.integer'                =>          '排序必须为正整数',
      'isShow.integer'              =>          '是否显示必须为正整数',
      'picture.image'                 =>        '图片格式必须为jpeg/png/bmp/gif/svg',
      'BannerId.integer'            =>          '轮播图分类必须为正整数',
    ];
  }
}
