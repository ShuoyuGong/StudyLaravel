<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  /**
   * 获取分类列表
   */
  public static function getClassificationList()
  {
    $cates = self::OrderBy('sort', 'Desc')->OrderBy('id', 'Desc')->get();
    $sortCates = self::sortCates($cates);
    return $sortCates;
  }

  /**
   * 将获取到的数据进行重新编排
   * 
   */
  private static function sortCates($data, $pid = 0, $level = 0)
  {
    $arr = [];
    foreach ($data as $item) {
      if ($item->pid == $pid) {
        $item->level = $level;
        $arr[] = $item;
        $arr_tmp = self::sortCates($data, $item->id, $level + 1);
        $arr = array_merge($arr, $arr_tmp);
      }
    }
    return $arr;
  }

  /**
   *获取$id中的子分类 
   */
  public static function getIdsChild($id)
  {
    $ids[] = $id;
    $data = self::all();
    $child = self::sortCates($data, $id);
    foreach ($child as $item) {
      $ids[] = $item->id;
    }
    return $ids;
  }
}
