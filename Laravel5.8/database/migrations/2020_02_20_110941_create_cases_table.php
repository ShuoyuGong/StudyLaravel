<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCasesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('cases', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('title', 30)->comment('标题');
      $table->string('abstract', 100)->comment('摘要');
      $table->string('picture', 150)->comment('图片');
      $table->integer('sort')->default(100)->comment('排序');
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
    Schema::dropIfExists('cases');
  }
}
