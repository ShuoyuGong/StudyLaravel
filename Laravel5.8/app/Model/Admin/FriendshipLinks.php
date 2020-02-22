<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class FriendshipLinks extends Model
{
  // 取消默认往数据库中写入的created_at和updated_at字段
  public $timestamps = false;
}
