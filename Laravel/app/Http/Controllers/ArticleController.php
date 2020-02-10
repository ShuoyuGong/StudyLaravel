<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * **********************GET /article HTTP/1.1
     */
    public function index()
    {
        //
        echo '这里是文章显示的首页';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * **********************GET /article/create HTTP/1.1
     */
    public function create()
    {
        //
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * **********************POST /article HTTP/1.1
     */
    public function store(Request $request)
    {
        //
        echo '文章的插入操作';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * **********************GET /article/{id} HTTP/1.1
     */
    public function show($id)
    {
        //
        echo '文章详情ID为'.$id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * **********************GET /article/{id} HTTP/1.1
     */
    public function edit($id)
    {
        //
        echo '这是文章的编辑页面';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * **********************PUT[PATCH] /article/{id} HTTP/1.1
     */
    public function update(Request $request, $id)
    {
        //
        echo '这是文章的更新页面';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * **********************DELETE /article/{id} HTTP/1.1
     */
    public function destroy($id)
    {
        //
        echo '这是文章的删除页面';
    }
}
