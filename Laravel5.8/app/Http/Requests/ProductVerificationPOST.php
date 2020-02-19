<?php

namespace App\Http\Requests;

use App\Rules\CheckCategoryPid;
use App\Rules\CheckCidChild;
use Illuminate\Foundation\Http\FormRequest;

class ProductVerificationPOST extends FormRequest
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
      'title'             =>        'required|max:20',
      'cid'               =>        ['required', 'integer', new CheckCidChild()],
      'keyWord'           =>        'required|max:30',
      'views'             =>        'required|integer',
      'picture'           =>        'required|image',
      'describe'          =>        'required|max:100',
      'abstract'          =>        'required|max:100',
      'content'           =>        'required|max:9999',
    ];
  }

  /**
   * 格式不正确返回信息
   */
  public function messages()
  {
    return [
      'title.required'          =>        '产品名称为必填项,不能为空',
      'title.max'               =>        '产品名称最长字符为20个',
      'cid.required'            =>        '产品分类必填项,请先创建或选择分类项',
      'cid.integer'             =>        '产品分类必须为整数',
      'keyWord.required'        =>        '产品关键字必填项,不能为空',
      'keyWord.amx'             =>        '产品关键字最长字符为30个',
      'views.required'          =>        '产品浏览量为必填项,不能为空',
      'views.required'          =>        '产品浏览量必须为整数',
      'picture.required'        =>        '必须上传产品图片',
      'picture.image'           =>        '图片格式必须为jpeg/png/bmp/gif/svg',
      'describe.required'       =>        '产品描述为必填项,不能为空',
      'describe.max'            =>        '产品描述最长字符为100',
      'abstract.required'       =>        '产品摘要必填项,不能为空',
      'abstract.max'            =>        '产品摘要最长字符为100',
      'content.required'        =>        '产品内容必填项,不能为空',
      'content.max'             =>        '产品内容最长字符为9999',
    ];
  }
}
