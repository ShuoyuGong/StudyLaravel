<?php

namespace App\Rules;

use App\Model\Admin\Category;
use Illuminate\Contracts\Validation\Rule;

/******************
 * 创建本文件的语句
 * php artisan make:rule CheckCategoryPid
 */
class CheckCategoryPid implements Rule
{
  /**
   * Create a new rule instance.
   *
   * @return void
   */


  private $pid;

  public function __construct($pid)
  {
    $this->pid = $pid;
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
    $ids = Category::getIdsChild($value);
    if (in_array($this->pid, $ids)) {
      return false;
    }
    return true;
  }

  /**
   * Get the validation error message.
   *
   * @return string
   */
  public function message()
  {
    return '上级分类设置不正确';
  }
}
