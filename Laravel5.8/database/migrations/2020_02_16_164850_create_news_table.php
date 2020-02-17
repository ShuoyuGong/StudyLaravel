<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('news', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('title')->comment('标题');
      $table->string('keyWord')->comment('关键字');
      $table->longText('describe')->comment('描述');
      $table->longText('abstract')->comment('摘要');
      $table->longText('picture')->comment('图片');
      $table->integer('views')->default(0)->comment('浏览量');
      $table->text('content')->comment('正文');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('news');
  }
}
