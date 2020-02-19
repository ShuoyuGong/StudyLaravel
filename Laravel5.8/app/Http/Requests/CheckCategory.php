<?php

namespace App\Http\Requests;

use App\Rules\CheckCategoryPid;
use Illuminate\Foundation\Http\FormRequest;

/************
 * 创建本文件的语句
 * php artisan make:request CheckCategory 
 */

class CheckCategory extends FormRequest
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
      'id'              =>    ['sometimes', new CheckCategoryPid($this->categoryPid)],
      'categoryName'    =>    'sometimes|required|max:10',
      'categorySort'    =>    'sometimes|required|integer',
      'categoryPid'     =>    'sometimes|required',
    ];
  }

  /***************
   * 不符合验证规则返回的数据
   */
  public function messages()
  {
    return [
      'categoryName.required'     =>      '分类名称不能为空',
      'categoryName.max'          =>      '分类名称最大字符长度不能超过10个字符',
      'categorySort.required'     =>      '排序不能为空',
      'categorySort.integer'      =>      '分类名称必须为整数',
      'categoryPid.required'      =>      '上级名称不能为空',
    ];
  }
}
