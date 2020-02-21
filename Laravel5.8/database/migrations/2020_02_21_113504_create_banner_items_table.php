<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannerItemsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('banner_items', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->integer('BannerId')->default(0)->comment('Banner表主键');
      $table->string('picture', 150)->comment('轮播图片');
      $table->string('title', 60)->comment('标题');
      $table->string('digest', 150)->comment('概述');
      $table->integer('sort')->default(100)->comment('排序');
      $table->integer('isShow')->default(0)->comment('是否显示');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('banner_items');
  }
}
