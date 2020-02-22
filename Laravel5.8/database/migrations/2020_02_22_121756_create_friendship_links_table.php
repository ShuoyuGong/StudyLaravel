<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFriendshipLinksTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('friendship_links', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('title', 50)->comment('标题');
      $table->string('url', 200)->comment('链接地址');
      $table->integer('sort')->default(100)->comment('排序');
      $table->string('alt', 30)->comment('鼠标悬浮提示信息');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('friendship_links');
  }
}
