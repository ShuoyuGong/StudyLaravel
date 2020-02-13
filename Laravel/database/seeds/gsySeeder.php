<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
// use DB;

class gsySeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $arr = [];
    // 循环
    for ($i = 0; $i < 100; $i++) {
      $tmp = [];
      $tmp['username'] = str_random(10);
      $tmp['password'] = str_random(20);
      $tmp['email']    = rand(100000, 99999999999) . '@qq.com';
      $tmp['address']  = str_random(60);
      $tmp['sex']      = rand(0, 1);

      // 压入到数组中
      $arr[] = $tmp;
    }
    // 插入
    DB::table('gsy')->insert($arr);
  }
}
