<?php

namespace App\Rules;

use App\Model\Admin\Category;
use Illuminate\Contracts\Validation\Rule;

class CheckCidChild implements Rule
{
  /**
   * Create a new rule instance.
   *
   * @return void
   */
  public function __construct()
  {
    //
  }

  /**
   * Determine if the validation rule passes.
   *
   * @param  string  $attribute
   * @param  mixed  $value
   * @return bool
   */
  public function passes($attribute, $value)
  {
    //$value时Cid 的 ID值
    $blur = Category::getIdsChild($value);
    if ($blur === [$value]) {
      return true;
    };
    return false;
  }

  /**
   * Get the validation error message.
   *
   * @return string
   */
  public function message()
  {
    return '不能在该分类下添加产品';
  }
}
