<?php

use Illuminate\Database\Seeder;

class Teacher_info extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    //
    $data = [];
    // 循环
    for ($i = 0; $i < 1000; $i++) {
      $tmp = [];
      $tmp['Tname'] = str_random(5);
      $tmp['Tsex']  = rand(0, 1);
      $tmp['Tzhiwu'] = str_random(10);
      $data[] = $tmp;
    }
    DB::table('teacher_info')->insert($data);
  }
}
