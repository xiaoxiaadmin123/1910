<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Hotlink;
class HotlinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $link =  Hotlink::all();
        //  dd($link);
         return view('admin.hotlink.index',['link'=>$link]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.hotlink.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    public function store(Request $request)
    {
           // 排除接收***
        $post = request()->except(['_token','/hotlink/store']);
        //    dd($post);
         // 文件上传判断
         if (request()->hasFile('link_logo')){
            $post['link_logo'] = upload('link_logo');
        };
        //添加
        $res = Hotlink::create($post);
        // dd($res);
        if($res){
            return redirect('/hotlink');
        } 
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
    public function edit($id)
    {
        $link = Hotlink::find($id);
        // dd($link);
        return view('admin.hotlink.edit',['link'=>$link]);
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
        $post = request()->except(['_token','/hotlink/update/'.$id]);
        // dd($post);
          // 文件上传判断
        if (request()->hasFile('link_logo')){
            $post['link_logo'] = upload('link_logo');
        };
        $res = Hotlink::where('link_id',$id)->update($post); 
        // dd($res);
        if($res!==false){
            return redirect('/hotlink');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Hotlink::destroy($id);
        //  dd($res);
         if($res){
             return redirect('/hotlink');
         }
    }
}
