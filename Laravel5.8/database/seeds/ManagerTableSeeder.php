<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ManagerTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $data = [
      'username'  =>    'admin',
      'password'  =>    bcrypt('1763034gong'),
    ];
    DB::table('managers')->insert($data);
    $data = [
      'username'  =>    'test',
      'password'  =>    bcrypt('test'),
      'status'    =>    0,
    ];
    DB::table('managers')->insert($data);
  }
}
