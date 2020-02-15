<?php

namespace App\Http\Controllers\Admin;

use App\Friend;
use App\Http\Requests\StoreFriendPost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Friend::OrderBy("sort","Desc")->OrderBy("id","Desc")->get();
        return view('admin.friend.index')->with('list',$list);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.friend.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFriendPost $request)
    {
        $friendModel = new Friend();
        $friendModel->title = $request->title;
        $friendModel->url = $request->url;
        $friendModel->sort = $request->sort;
        $friendModel->key = $request->key;
        checkreturn($friendModel->save(),"添加");
        return redirect(route('admin.friend.index'));
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
    public function edit(Friend $friend)
    {
        return view('admin.friend.edit')->with('friend',$friend);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $friendModel = Friend::find($id);
        $friendModel->title = $request->title;
        $friendModel->url = $request->url;
        $friendModel->sort = $request->sort;
        $friendModel->key = $request->key;
        checkreturn($friendModel->save(),"修改");
        return redirect(route('admin.friend.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Friend $friend)
    {
        checkreturn($friend->delete(),"删除");
        return redirect(route('admin.friend.index'));
    }
}
