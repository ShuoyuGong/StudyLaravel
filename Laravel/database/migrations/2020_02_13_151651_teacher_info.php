<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class TeacherInfo extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    //
    Schema::create('teacher_info', function (Blueprint $table) {
      // 创建主键ID字段
      $table->increments('id')->comment('主键ID');
      // 创建 教师名字 字段
      $table->string('Tname')->nullable()->default('teacher_info')->comment('用户名，不能为空');
      // 创建 性别 字段
      $table->boolean('Tsex')->comment('性别');
      // 新增 邮箱 字段
      $table->string('Tzhiwu')->comment('教师职务');
      // 设置表的引擎 
      $table->engine = 'innodb';
    });
  }

  /**
   * Reverse the migrations.
   * 
   * @return void
   */
  public function down()
  {
    //
    Schema::drop('teacher_info');
  }
}
