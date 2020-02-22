<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FriendshipLinksPOST;
use App\Model\Admin\FriendshipLinks;
use DB;

class FriendshipLinksController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $friendshipLinksList = FriendshipLinks::OrderBy('sort', 'Desc')->OrderBy('id', 'Desc')->get();
    return view('admin.friendshipLinks.indexFriendshipLinks')->with('friendshipLinksList', $friendshipLinksList);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admin.friendShipLinks.createFriendshipLinks');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(FriendshipLinksPOST $request)
  {
    $friendshipLinks              =          new FriendshipLinks();
    $friendshipLinks->title       =          $request->title;
    $friendshipLinks->url         =          $request->url;
    $friendshipLinks->sort        =          $request->sort;
    $friendshipLinks->alt         =          $request->alt;
    checkRes($friendshipLinks->save(), '添加友情链接项目');
    return redirect(route('admin.friendshipLinks.index'));
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(FriendshipLinks $friendshipLinks, $id)
  {
    $friendshipLinks = FriendshipLinks::find($id);
    return view('admin.friendshipLinks.editFriendshipLinks')->with('friendshipLinks', $friendshipLinks);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(FriendshipLinksPOST $request, $id)
  {
    $friendshipLinks              =          FriendshipLinks::find($id);
    $friendshipLinks->title       =          $request->title;
    $friendshipLinks->url         =          $request->url;
    $friendshipLinks->sort        =          $request->sort;
    $friendshipLinks->alt         =          $request->alt;
    checkRes($friendshipLinks->save(), '编辑友情链接项目');
    return redirect(route('admin.friendshipLinks.index'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $res = DB::table('friendship_links')->delete($id);
    checkRes($res > 0, '删除轮播图项目');
    return redirect(route('admin.friendshipLinks.index'));
  }


  /**
   * 定义setSort进行 AJAX异步排序
   */
  public function setSort()
  {
     
  }
}
