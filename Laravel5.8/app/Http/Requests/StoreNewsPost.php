<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsPost extends FormRequest
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
      'title'     =>  'required|max:240',
      'keyWord'   => 'required|max:240',
      'views'     =>  'required|integer',
      'describe'  => 'required|max:240',
      'abstract'  => 'required|max:240',
      'content'   => 'required|max:10000',
    ];
  }
  public function messages()
  {
    return [
      'title.required'        =>    '新闻标题为必填项，不能为空',
      'title.max'             =>    '新闻标题内容不能超过240字',
      'keyWord.required'      =>    '新闻关键字为必填项，不能为空',
      'keyWord.max'           =>    '新闻关键字内容不能超过240',
      'views.required'        =>    '浏览量为必填项，不能为空',
      'views.integer'         =>    '浏览量必须为整数',
      'describe.required'     =>    '新闻描述为必填项，不能为空',
      'describe.max'          =>    '新闻描述内容不能超过240字',
      'abstract.required'     =>    '新闻摘要为必填项，不能为空',
      'abstract.max'          =>    '新闻摘要内容不能超过240',
      'content.required'      =>    '新闻内容为必填项，不能为空',
      'content.max'           =>    '新闻内容内容不能超过10000字',
    ];
  }
}
