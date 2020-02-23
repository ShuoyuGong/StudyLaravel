<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyProfilesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('company_profiles', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->integer('type')->default(1)->comment('1:公司简介 2:招贤纳士 3:发展历程');
      $table->string('title', 50)->comment('标题');
      $table->string('describe', 150)->nullable(true)->comment('描述');
      $table->string('picture', 150)->nullable(true)->comment('图片');
      $table->text('detail', 150)->nullable(true)->comment('详情');
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
    Schema::dropIfExists('company_profiles');
  }
}
