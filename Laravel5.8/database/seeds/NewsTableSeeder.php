<?php

use Illuminate\Database\Seeder;

class NewsTableSeeder extends Seeder
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
    for ($i = 0; $i <= 50; $i++) {
      $data[] = [
        'title'   =>  Str::random(10),
        'keyWord' =>  Str::random(15),
        'describe' => Str::random(30),
        'abstract' =>  Str::random(500),
        'picture' =>  Str::random(50),
        'content' =>  Str::random(1000),
        'created_at'  => date('Y-m-d H:i:s'),
        'updated_at'  => date('Y-m-d H:i:s'),
      ];
    }
    DB::table('News')->insert($data);
  }
}
