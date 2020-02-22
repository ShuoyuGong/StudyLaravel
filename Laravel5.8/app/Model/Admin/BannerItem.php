<?php

namespace App\Model\Admin;

use App\Events\BannerPictureDeleteEvent;
use App\Model\Admin\Banner;
use Illuminate\Database\Eloquent\Model;

class BannerItem extends Model
{
  // 取消默认往数据库中写入的created_at和updated_at字段
  public $timestamps = false;

  /*** 
   *关联banners 轮播图分类表
   */
  public function banner()
  {
    // return $this->belongsTo("App\Model\Admin\Banner", "BannerId");
    return $this->belongsTo(new Banner, "BannerId");
  }

  /***
   * 当删除时触发 BanneritemDeleteEvent 事件
   */
  protected $dispatchesEvents = [
    'deleted'    =>      BannerPictureDeleteEvent::class,
  ];

  /***
   * 数据库字段修改器
   * 把 是否显示 字段的原始值1 0 做修改
   * 字段首字母大写
   */
  public function getIsShowAttribute($value)
  {
    return $value ? "显示" : "隐藏";
  }
}
