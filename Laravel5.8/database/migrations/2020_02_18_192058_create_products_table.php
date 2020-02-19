<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('products', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->integer('cId')->default(0)->comment('所属分类');
      $table->string('title', 20)->comment('标题');
      $table->string('keyWord', 30)->comment('关键字');
      $table->longText('describe')->comment('描述');
      $table->longText('abstract')->comment('摘要');
      $table->string('picture', 150)->comment('图片');
      $table->integer('isRecommend')->default(0)->comment('是否推荐');
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
    Schema::dropIfExists('products');
  }
}
