<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class Test extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    // 判断数据库有无 gsy 表
    if (!Schema::hasTable('gsy')) {
      //创建表
      Schema::create('gsy', function (Blueprint $table) {
        // 创建主键字段
        $table->increments('id')->comment('主键ID');
        // 创建用户名字段
        $table->string('username')->nullable()->default('gsy')->comment('用户名，不能为空');
        // 创建密码字段
        $table->char('password', 100)->comment('密码');
        // 新增 邮箱 字段
        $table->string('email')->comment('邮箱');
        // 新增地址字段
        $table->char('address', 200)->comment('地址');
        // 用户名 字段 唯一索引
        $table->unique('username');
        // 邮箱 字段 一般索引
        $table->index('email');
        // 设置表的引擎 
        $table->engine = 'innodb';
      });
    } else {
      // 如果表存在的话 调整表结构
      Schema::table('gsy', function (Blueprint $table) {
        if (!Schema::hasColumn('gsy', 'love')) {
          $table->string('love');
        }
      });
    }
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    //刷新回滚删除gsy表 重新创建
    // Schema::drop('gsy');
  }
}
