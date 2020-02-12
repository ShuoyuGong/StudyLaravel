<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DbController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
    return "数据库基本操作";
  }

  // 查询数据
  public function select()
  {
    // 原生sql 语句查询
    // $res = DB::select("select * from user_info where id = 2");

    // 使用占位符
    $res = DB::select("select * from user_info where id = ?", [3]);
    var_dump($res);
  }

  // 显示查询数据表单页面
  public function insertIndex()
  {
    return view('Db.insertIndex');
  }

  // 插入数据
  public function insert(Request $request)
  {
    $data = $request->all();

    $res = DB::insert('insert into user_info 
                        (id,name,sex,phoneNum,email,address)
                          values
                        (null,?,?,?,?,?)', [
      $data['username'], $data['sex'], $data['phoneNum'], $data['email'], $data['address']
    ]);
    var_dump($res);
  }

  // 修改数据
  public function update()
  {
    // $res = DB::update("update user_info set name = '宋雨涵' where id = 2");
    $res = DB::update("update user_info set sex = ? where id = ?", ["无", 3]);
    var_dump($res);
  }

  // 删除数据
  public function delete()
  {
    $res = DB::delete("delete from user_info  where id = 2");
    // $res = DB::delete("delete from user_info  where id = ?", [3]);
    var_dump($res);
  }

  // 一般语句
  public function statement()
  {
    // 创建表
    // $res = DB::statement("
    //   create table admin_info(
    //     id int primary key auto_increment,
    //     name char(20) not null
    // )");

    // 删除表
    $res = DB::statement("
      drop table admin_info
    ");
    var_dump($res);
  }

  // 事务操作
  public function shiwu()
  {
    // 开启事务
    DB::beginTransaction();
    // 执行sql
    // 扣钱
    $res = DB::update("update user_money set money = money - ? where id = ?", [2000, '0']);
    // 加钱
    $res2 = DB::update("update user_money set money = money + ? where id = ?", [2000, '2']);

    // var_dump($res . '+++++++++++++++' . $res2);
    if ($res && $res2) {
      DB::commit();
      echo "转账成功";
    } else {
      DB::rollBack();
      echo "转账失败";
    }
  }

  // 操作多个数据库
  public function dbs()
  {
    $res = DB::connection('slaver-1')->select("select * from user");
    dd($res);
  }

  // 插入构造器
  public function insertStructure()
  {
    // 单条插入
    // $res = Db::table('user_info')->insert([
    //   'id'        =>  null,
    //   'name'      =>  'gsy',
    //   'sex'       =>  '男',
    //   'phoneNum'  =>  '17630345220',
    //   'email'     =>  '2788696894@qq.com',
    //   'address'   =>  '河南职业技术学院',
    // ]);

    // 多条插入
    // $res = Db::table('user_info')->insert(
    //   [
    //     [
    //       'id'        =>  null,
    //       'name'      =>  'gsy',
    //       'sex'       =>  '男',
    //       'phoneNum'  =>  '17630345220',
    //       'email'     =>  '2788696894@qq.com',
    //       'address'   =>  '河南职业技术学院',
    //     ],
    //     [
    //       'id'        =>  null,
    //       'name'      =>  'gsy',
    //       'sex'       =>  '男',
    //       'phoneNum'  =>  '17630345220',
    //       'email'     =>  '2788696894@qq.com',
    //       'address'   =>  '河南职业技术学院',
    //     ],
    //     [
    //       'id'        =>  null,
    //       'name'      =>  'gsy',
    //       'sex'       =>  '男',
    //       'phoneNum'  =>  '17630345220',
    //       'email'     =>  '2788696894@qq.com',
    //       'address'   =>  '河南职业技术学院',
    //     ],
    //     [
    //       'id'        =>  null,
    //       'name'      =>  'gsy',
    //       'sex'       =>  '男',
    //       'phoneNum'  =>  '17630345220',
    //       'email'     =>  '2788696894@qq.com',
    //       'address'   =>  '河南职业技术学院',
    //     ]
    //   ]
    // );

    // 获取ID插入
    $res = DB::table('user_info')->insertGetId(
      [
        'id'        =>  null,
        'name'      =>  'gsy',
        'sex'       =>  '男',
        'phoneNum'  =>  '17630345220',
        'email'     =>  '2788696894@qq.com',
        'address'   =>  '河南职业技术学院',
      ]
    );
    var_dump($res);
  }

  // 更新构造器
  public function updateStructure()
  {
    $res = DB::table('user_info')->where('id', '=', 1)->update(['name' => 'xdd']);

    var_dump($res);
  }

  // 删除构造器
  public function deleteStructure()
  {
    $res = Db::table('user_info')
      ->where('id', '>', '20')
      ->delete();

    var_dump($res);
  }

  // 查询构造器
  public function selectStructure()
  {
    // 查询全部数据
    // $res = DB::table('user_info')->get();

    // 查询单条数据
    // $res = DB::table('user_info')->first();

    // 查询单条结果中的某个字段
    // $res = DB::table('user_info')->where('id', '=', '8')->value('name');

    // 获取一列数据
    $res = DB::table('user_info')->where('id', '>', '10')->lists('id');
    dd($res);
  }

  // 连贯操作
  public function coherent()
  {
    // 设置字段
    // $res = DB::table('user_info')
    //   ->select("name", "sex")
    //   ->get();
    // dd($res);

    // 条件 where和orWhere
    // $res = DB::table('user_info')
    //   ->select("name", "sex")
    //   ->where('id', '>', 10)
    //   ->orWhere('id', '=', 1)
    //   ->get();

    // whereBetween
    // $res = DB::table('user_info')
    //   ->whereBetween('id', [5, 10])
    //   ->get();

    // whereIn
    // $res = DB::table('user_info')
    //   ->whereIn('id', [5, 10])
    //   ->get();

    // 排序
    // $res = DB::table('user_info')
    //   ->orderBy('id', 'desc')
    //   ->get();

    // 分页
    // $res = DB::table('user_info')
    //   ->skip(5)
    //   ->take(5)
    //   ->get();

    // 连接表
    // $res = DB::table('shop_info')
    //   ->leftJoin('shop_type', 'shop_info.sid', '=', 'shop_type.id')
    //   ->select('shop_info.*', 'shop_type.shop_name')
    //   ->get();

    // 计算 
    // 计数 count
    // $res = DB::table('shop_info')->count();

    // 最大值
    // $res = DB::table('shop_info')->max('price');

    // 最小值
    // $res = DB::table('shop_info')->min('price');

    // 平均值
    $res = DB::table('shop_info')->avg('price');
    dd($res);
  }
}
